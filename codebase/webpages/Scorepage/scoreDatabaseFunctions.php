<?php
#######################################################################################################################
## This class offers all functions for the user database and fraction database, despite the name. oops.
## Common user error checking can be accomplished by checking the types of dynamically
#######################################################################################################################
class scoreDatabaseFunctions
{
    //constructor for a ranking board
    public $ranking;
    public $dbconn;
    //constructor for a ranking board, sets values of $this->dbconn and $this->ranking, for use in scoreboards
    function __construct(){
        $this->makeConnection();
        //$this->rankingTable();
    }
    
    //Connects to the database
    function makeConnection(){
        //This sets the connection up, also has the password included
        $servername = "127.0.0.1";
        $sqlusername = "fractio3_user";
        $sqlpassword = "edcvfr43edcvfr4";
        $dbname = "fractio3_dba";
        //these variables are for status reporting
        $connectionstatus = "Connection not attempted.";
        $connectbool = false;
        mysqli_report(MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ALL);
        try {
            // Create connection, username and pw here are for the sql server
            $this->dbconn = mysqli_connect($servername, $sqlusername, $sqlpassword, $dbname);
            // Check connection and report errors
            error_reporting(E_ALL);
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            $connectionstatus = "Connection Successful.";
            $connectbool = true;
        } catch (mysqli_sql_exception $e){
            $connectionstatus = "Connection to server failed";
            echo $connectionstatus;
        }

    }
    
    //function to make an initial ranking table.
    function rankingTable(){
        return mysqli_query($this->dbconn, "SELECT users.user_name, users.user_score, users.digits, count(t2.user_name) score_rank
                FROM users
                LEFT JOIN users t2 ON t2.user_score >= users.user_score
                GROUP BY user_name, user_score, digits
                ORDER BY score_rank;");
    }
    //function to make ranking table for current singular user
    function userRankingTable(string $rankedusername){
        return mysqli_query($this->dbconn, "SELECT * from 
                (SELECT users.user_name, users.user_score, users.digits, count(t2.user_name) score_rank
                FROM users
                LEFT JOIN users t2 ON t2.user_score >= users.user_score
                GROUP BY user_name, user_score, digits
                ORDER BY score_rank) AS ranksubalias
                WHERE user_name = ('$rankedusername');");
    }
    //function to retrieve pre-existing digits strings, it returns a string as a status note, and changes public variables
    function retrieveDigits(mysqli $dbconn, $digits){
        //This is basic security to prevent code injection
        $digits = mysqli_real_escape_string($dbconn, $digits);

        //we turn currentDigits into a mysqli_query that the information can be pulled from
        $currentDigits = mysqli_query($dbconn, "SELECT * 
                FROM fractio3_dba.fractions 
                WHERE digits = ('$digits');");
        //return status code or score
        if($currentDigits->num_rows < 1){
            return " This is the first time these digits have been generated. ";
        }
        else{
            $incrementOne = digitsUpdate();
            return $currentDigits;
        }
        return "ERROR: Incorrect database permissions or disconnection.";
    }
    
    
    //function to retrieve a specific user's score, it returns a string as a status note, and changes public variables
    //check if is_string (Not !is_string) for error message
    function retrieveUserScore(mysqli $dbconn, $username){
        //this is security to prevent code injection
        $username = mysqli_real_escape_string($dbconn, $username);
        //we turn currentScore into a mysqli_query that the information can be pulled from
        $currentScore = mysqli_query($dbconn, "SELECT user_score 
                FROM fractio3_dba.users 
                WHERE user_name = ('$username');");
        //return status codes
        if($currentScore->num_rows < 1){
            return " User does not exist. ";
        }
        else{
            return $currentScore;
        }
    }
    
    //function to add a new user, dbconn must be mysqli, Additionally, error checking for pre-existing user is
    //carried out by checking if !is_string($this->addNewUser)
    function addNewUser(mysqli $dbconn, string $newname, string $newpass){
        //this is security to prevent code injection
        $newname = mysqli_real_escape_string($dbconn, $newname);
        $newpass = mysqli_real_escape_string($dbconn, $newpass);
        $userChecker = mysqli_query($dbconn, "SELECT * FROM fractio3_dba.users WHERE user_name = ('$newname')");
        if($newname == "" || $newpass == "" || $userChecker->num_rows > 0){
            return $userChecker;
        }
        else{
            $newuser = mysqli_query($dbconn, "INSERT INTO fractio3_dba.users VALUES (0,('$newname'), 0, ('$newpass'), '0')");
            return "Successful new user insertion.";
        }
    }
    
    function addNewDigits(mysqli $dbconn, string $newDigits, float $newFrac, int $newDivisor){
        //this is security to prevent code injection
        $newDigits = mysqli_real_escape_string($dbconn, $newDigits);
        if ((int)$newDigits > 999999999 || (int)$newDigits < 0){
            return "digits out of bounds";
        }
        if ($newFrac > 1 || $newFrac < 0){
            return "Fraction out of bounds, math implemented incorrectly.";
        }
        $digitsChecker = mysqli_query($dbconn, "SELECT * FROM fractio3_dba.fractions WHERE digits = ('$newDigits')");
        if($digitsChecker->num_rows > 0){
            $incrementor = mysqli_query($dbconn, "UPDATE fractio3_dba.fractions 
                SET times_generated = (times_generated + 1)
                WHERE digits = ('$newDigits');");
            $returnTimesGenerated = mysqli_query($dbconn, "SELECT fractions.times_generated FROM fractio3_dba.fractions 
                WHERE digits = ('$newDigits');");
            $row = mysqli_fetch_array($returnTimesGenerated);
            return (int)($row["times_generated"]-1);
        }
        else{
            $newDigits = mysqli_query($dbconn, "INSERT INTO fractio3_dba.fractions VALUES (('$newDigits'), 1, $newFrac, $newDivisor)");
            return "0";
        }
    }
    
    //Function to change user score and most recent input digits, digits should START as an int, and then be cast to
    //A string before being put into this.
    function setUserScore(mysqli $dbconn, string $name, int $userscore, string $digits){
        $name = mysqli_real_escape_string($dbconn, $name);
        $digits = mysqli_real_escape_string($dbconn, $digits);
        $scoreCheck = mysqli_query($dbconn, "SELECT user_score 
                FROM fractio3_dba.users 
                WHERE user_name = ('$name');");
        //return status codes
        if($scoreCheck->num_rows < 1){
            return " User does not exist. ";
        }
        $scoreCheck = mysqli_query($dbconn, "SELECT user_score 
                FROM fractio3_dba.users 
                WHERE user_name = ('$name') AND ('$userscore') > user_score;");
        if($scoreCheck->num_rows < 1){
            return " Not higher than your current highest score, too bad! ";
        }
        $scoreUpdate = mysqli_query($dbconn, "UPDATE fractio3_dba.users 
        SET user_score = ('$userscore'),
            digits = ('$digits')
            WHERE user_name = ('$name') AND ('$userscore') > user_score;");
        return $userscore;
    }
    
    //function to change user's password
    function changePass(mysqli $dbconn, string $name, string $oldpass, string $newpass){
        //input sanitization
        $name = mysqli_real_escape_string($dbconn, $name);
        $oldpass = mysqli_real_escape_string($dbconn, $oldpass);
        $newpass = mysqli_real_escape_string($dbconn, $newpass);
        //check for user existence
        $passfinder = mysqli_query($dbconn, "SELECT user_score 
                FROM fractio3_dba.users 
                WHERE user_name = ('$name');");
        //return status codes
        if($passfinder->num_rows < 1){
            return " User does not exist. ";
        }
        //check for old password being correct
        $passfinder = mysqli_query($dbconn, "SELECT user_score 
                FROM fractio3_dba.users 
                WHERE user_name = ('$name') AND password = ('$oldpass');");
        if($passfinder->num_rows < 1){
            return " Incorrect Password ";
        }
        //check if it's the same password
        $passfinder2 = mysqli_query($dbconn, "SELECT user_score 
                FROM fractio3_dba.users 
                WHERE user_name = ('$name') AND password = ('$newpass');");
        if($passfinder2->num_rows > 0){
            return " This is already your Password ";
        }
        //finally, change the password
        $passfinder = mysqli_query($dbconn, "UPDATE fractio3_dba.users 
        SET password = ('$newpass')
        WHERE user_name = ('$name') AND password = ('$oldpass');");
        return $passfinder;
    }
    
    //Function to delete a user
    function deleteUser(mysqli $dbconn, $name, $pass){
        //First query to find the entry password for this user and check for correct permissions
        $name = mysqli_real_escape_string($dbconn, $name);
        $pass = mysqli_real_escape_string($dbconn, $pass);
        $passfinder = mysqli_query($dbconn, "SELECT password
            FROM fractio3_dba.users
            WHERE user_name=('$name')
            ");
        if ($passfinder->num_rows == 0){
            return $passfinder;
        }
        $row = mysqli_fetch_array($passfinder);
        if ($row["password"] != $pass) {
            return $row;
        }
        //the second block is to find out if the user exists with the if statement, then check if the password is correct
        mysqli_query($dbconn, "DELETE FROM fractio3_dba.users
            WHERE user_name = ('$name') AND password = ('$pass');");
        return "Successfully deleted";
    }
    
    //checks user against login database
    function logIn(mysqli $dbconn, $name, $pass){
        $name = mysqli_real_escape_string($dbconn, $name);
        $pass = mysqli_real_escape_string($dbconn, $pass);
         //check for user existence
        $passfinder = mysqli_query($dbconn, "SELECT user_score 
                FROM fractio3_dba.users 
                WHERE user_name = ('$name');");
        //return status codes
        if($passfinder->num_rows < 1){
            return " User does not exist. ";
        }
        //check for password being correct
        $passfinder = mysqli_query($dbconn, "SELECT user_score 
                FROM fractio3_dba.users 
                WHERE user_name = ('$name') AND password = ('$pass');");
        if($passfinder->num_rows < 1){
            return " Incorrect Password ";
        }
        else{
            return $passfinder;
        }
    }

}
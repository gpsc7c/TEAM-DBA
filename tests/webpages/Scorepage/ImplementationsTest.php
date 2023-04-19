<!DOCTYPE html>
<?php
include './scoreDatabaseFunctions.php';
$ranks = new scoreDatabaseFunctions();
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>FRACTION RUNNER Scoreboard</title>
        <link rel="stylesheet" href="ScoreStyle.css" type="text/css">
        <script src="js/scoretable.js"></script>
    </head>

    <script><!--Javascript goes here--></script>
    <body>
        <header>
            <h1>FRACTION RUNNER</h1>
        </header>
        <div>
            <a href="../Homepage/GroupIntroPage.php"><button>Front Page</button></a>
        </div>
        <div>
            <a href="../Scorepage/ScorePage.php"><button>Extended Scoreboard</button></a>
        </div>
        <table class="scoretable">
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Name</th>
                    <th>Points</th>
                    <th>Repeating String</th>
                </tr>
            </thead>
            <tbody id = "scoreboard">
                <?php
                ##############
                /* Put a # in front of this line to test retrieveDigits in all forms, ensure that "Database Insert Test File" mysql query has been fired first
                //This variable is the test digits from the mysql example query
                try{
                    #$retDig = "0011100";
                    //the following pulls a nonexistant number, if this number exists, find one that doesn't or create a dummy copy of the database
                    $retDig = '7777';
                    //This line fires the retrieveDigits function which sets ranks->currentDigits rdtestvar stands for "retrieve digits test variable"
                    $rdtestvar = $ranks->retrieveDigits($ranks->dbconn, $retDig);
                    //this line echoes the status message
                    if (is_string($rdtestvar)) {
                        echo $rdtestvar;
                        $retFrac = 0.7777;
                        $retDiv = 9999;
                        //below is unfinished and will be until page works for users
                        $newDigits = $ranks->addNewDigits($ranks->dbconn, $retDig, $retFrac, $retDiv);
                        echo $newDigits;
                    }//this if statement fires if the digits have been inserted into the table previously "retrieve digits test array"
                    else if ($rdtestvar->num_rows > 0) {
                        $rdtestarr = mysqli_fetch_array($rdtestvar);
                        echo " " . $rdtestarr["fraction"] . " " . $rdtestarr["divisor"];
                    }
                }catch(mysqli_sql_exception $e){
                    echo " ERROR: Incorrect database permissions or disconnection. ";
                }
                #*/
                ##############
                ##############
                /* Put a # in front of this line to test retrieveScore in all forms, ensure that "Database Insert Test File" mysql query has been fired first
                //This variable is the test username from the mysql example query. the double quotes + single quotes are necessary both for security and for
                $retScore ="test7";
                //uncomment to test a pull on a nonexistant name, if this name exists, find one that doesn't or create a dummy copy of the database
                #$retScore = 'zyuyuiuyi';
                //this line retrieves the now set currentDigits rstestvar stands for "retrieve score test variable"
                $rstestvar = $ranks->retrieveUserScore($ranks->dbconn, $retScore);
                //this line echoes the status message if necessary
                if (is_string($rstestvar))
                {
                    echo $rstestvar;
                }
                //this if statement fires if the digits have been inserted into the table previously "retrieve digits test array"
                else{
                    $rstestarr=mysqli_fetch_array($rstestvar);
                    echo " Score of ".$retScore." is ".$rstestarr["user_score"];
                }
                #*/
                ##############
                ##############
                /* Put a # in front of this line to test addNewUser
                //Test for prevention of existing user input, dynamically cast variables for
                try {
                    $newuser = "test1";
                    $newpw = "password";
                    $insertTester = $ranks->addNewUser($ranks->dbconn, $newuser, $newpw);
                    if (!is_String($insertTester)){
                        echo "ERROR: Username already exists";
                    }
                } catch(mysqli_sql_exception $e2){
                    echo " ERROR: Incorrect database permissions or disconnection. ";
                }
                //test for adding new user
                try {
                    $newuser = "test31";
                    $newpw = "V1t7pY";
                    $insertTester = $ranks->addNewUser($ranks->dbconn, $newuser, $newpw);
                    if (!is_String($insertTester)){
                        echo " This should not be displayed if the database is set up and you've only reload-tested this once. ";
                        echo "ERROR: Username already exists";
                    }
                } catch(mysqli_sql_exception $e2){
                    echo " ERROR: Incorrect database permissions or disconnection. ";
                }
                #*/
                ##############
                ##############
                /* Put a # in front of this line to test deleteUser
                try {
                    $deluser = "test30";
                    $delpw = "V1t7pY";
                    $deleteTester = $ranks->deleteUser($ranks->dbconn, $deluser, $delpw);
                    if(is_string($deleteTester)){
                        echo $deleteTester;
                    }
                    else if(is_array($deleteTester)){
                        echo "Incorrect Password";
                    }
                    else{
                        echo "User does not exist";
                    }
                }catch(mysqli_sql_exception $e2){
                    echo mysqli_error($ranks->dbconn);
                    echo "ERROR: Incorrect database permissions or disconnection.";
                }
                #*/
                ##############
                ##############
                /* put a # before this line to test setUserScore
                try {
                    $scorename = "test1";
                    $newscore = "502";
                    $scoredigits = "115115";
                    $setTester = $ranks->setUserScore($ranks->dbconn, $scorename, $newscore, $scoredigits);
                    if (is_string($setTester)){
                        echo $setTester;
                    }
                    else {
                        echo "Congratulations on your new High Score of ".$setTester."!";
                    }
                }catch(mysqli_sql_exception $e){
                    echo mysqli_error($ranks->dbconn);
                    echo "ERROR: Incorrect database permissions or disconnection.";
                }
                #*/
                /*put a # before this line to test setUserScore
                try {
                    $scorename = "test1";
                    $oldpass = "115115";
                    $newpass = "115115";
                    $changeTester = $ranks->changePass($ranks->dbconn, $scorename, $oldpass, $newpass);
                    if (is_string($changeTester)){
                        echo $changeTester;
                    }
                    else{
                        echo "Password Changed";
                    }
                }catch(mysqli_sql_exception $e){
                    echo mysqli_error($ranks->dbconn);
                    echo "ERROR: Incorrect database permissions or disconnection.";
                }
                #*/

                $ranks->rankingTable();
                if ($ranks->ranking->num_rows > 0) {
                    // iterator for output data of each row
                    $i = 1;
                    // do not swap the order of the checks in the while statement w/o adding parentheses,
                    // doing so sets $row to a boolean.
                    while($i <= 100 && $row = mysqli_fetch_array($ranks->ranking)) {
                        echo "<tr><td>".$row["score_rank"]."</td><td>".$row["user_name"]."</td><td>".$row["user_score"]."</td><td>".$row["digits"]."</td></tr>";
                        $i++;
                    }
                } else {
                    echo "0 results";
                }
                ?>
            </tbody>
        </table>
        <div>
            <a href="../Homepage/GroupIntroPage.php"><button>Front Page</button></a>
        </div>
        <div>
            <a href="../Gamepage/index.php"><button>Play Game</button></a>
        </div>
        <footer>
            <p>
                All rights reserved
            </p>
        </footer>
    </body>
</html>

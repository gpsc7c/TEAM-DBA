<?php
session_start();
include '../Scorepage/scoreDatabaseFunctions.php';
$ranks = new scoreDatabaseFunctions();
$servername ="127.0.0.1";
$username = "fractio3_user";
$password = "edcvfr43edcvfr4";
$dbname = "fractio3_dba";

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error){
	die("connection failed");
}

$name = $_POST["name"];
$pass = $_POST["password"];
$salt = "fractio3_dba";
$pass_encrypted = sha1($pass.$salt);

try{
    
        //fire login function
        #$sql = $ranks->logIn($ranks->dbconn, $name,$pass);
        $sql = $ranks->logIn($ranks->dbconn, $name,$pass_encrypted);
        //in cases where login successful and no error out
        if(!is_string($sql)){
            
            $_SESSION['username'] = $name;
            $_SESSION['loggedin'] = true;
            
        	echo '<script>alert("Login successful");</script>';
            echo "<script type='text/javascript'>location.assign('../index.php');</script>";
        }
        
        //failure states
        else{
        	echo "<script>alert('ERROR:".$sql."');</script>";
        	echo "<script type='text/javascript'>location.assign('./signlog.php');</script>";
        }
    //error states
}catch(mysqli_sql_exception $e2){
    echo "<script>alert('ERROR: Incorrect database permissions or disconnection. ');</script>";
    echo "<script type='text/javascript'>location.assign('./signlog.php');</script>";
}

?>

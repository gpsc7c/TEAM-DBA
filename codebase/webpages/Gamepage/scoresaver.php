<?php
session_start();
include '../Scorepage/scoreDatabaseFunctions.php';
$ranks = new scoreDatabaseFunctions();
$userscore = $_POST['score'];
echo $userscore;
$name = $_SESSION['username'];
$digits = $_SESSION['digits'];

try{
    $sql = $ranks->setUserScore($ranks->dbconn, $name, $userscore, $digits);
    //error codes
    if (is_string($sql)){
        echo "<script>alert('ERROR:".$sql."');</script>";
        	
    }
    else{
        echo "<script>alert('successfully uploaded');</script>";
    }
    
}catch(mysqli_sql_exception $e){
    echo "<script>alert('ERROR: Incorrect database permissions or disconnection. ');</script>";
    echo "<script type='text/javascript'>location.assign('./signlog.php');</script>";
}

?>
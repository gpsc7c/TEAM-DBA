<?php
session_start();
include '../Scorepage/scoreDatabaseFunctions.php';
$ranks = new scoreDatabaseFunctions();
$userscore = $_COOKIE['userscore'];
echo $userscore;
$name = $_SESSION['username'];
$digits = $_SESSION['digits'];

try{
    $sql = $ranks->setUserScore($ranks->dbconn, "test", $userscore, "0909");
}catch(mysqli_sql_exception $e){
    
}

?>
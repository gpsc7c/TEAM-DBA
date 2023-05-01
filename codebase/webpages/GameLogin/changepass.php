<?php
session_start();
include '../Scorepage/scoreDatabaseFunctions.php';
$ranks = new scoreDatabaseFunctions();

$name = $_SESSION["username"];
$oldpass = $_POST["oldpassword"];
$newpass = $_POST["newpassword"];
$salt = "fractio3_dba";
$oldpass_encrypted = sha1($oldpass.$salt);
$newpass_encrypted = sha1($newpass.$salt);

try{
    
        //fire change password function
        $sql = $ranks->changePass($ranks->dbconn, $name,$oldpass_encrypted, $newpass_encrypted);
        //NOTDONENOTDONENOTDONE
        if(is_string($sql)){
        	echo "<script>alert('ERROR: ".$sql."');</script>";
            echo "<script type='text/javascript'>location.assign('./signout.php');</script>";
        }
        
        //failure states
        else{
        	echo "<script>alert('Password change successful.');</script>";
        	echo "<script type='text/javascript'>location.assign('./signout.php');</script>";
        }
    
    //error states
}catch(mysqli_sql_exception $e2){
    echo "<script>alert('ERROR: Incorrect database permissions or disconnection. ');</script>";
    echo "<script type='text/javascript'>location.assign('./signlog.php');</script>";
}
?>
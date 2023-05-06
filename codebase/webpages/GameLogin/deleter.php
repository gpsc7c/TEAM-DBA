<?php session_start();
include '../Scorepage/scoreDatabaseFunctions.php';
$ranks = new scoreDatabaseFunctions();
$name = $_SESSION['username'];
$score = $_GET['userscore'];

try{
    
        //fire user delete function
        #$sql = $ranks->logIn($ranks->dbconn, $name,$pass);
        $sql= $ranks->deleteUser($ranks->dbconn, $name, $pass_encrypted);
        //in cases where delete unsuccessful and error out
        if(!is_string($sql) && !is_array($sql)){
        	echo '<script>alert("ERROR: User does not exist, or you are no longer logged in.");</script>';
            echo "<script type='text/javascript'>location.assign('./signout.php');</script>";
        }
        else if(is_array($sql)){
            echo "<script>alert('ERROR: Incorrect Password');</script>";
        	echo "<script type='text/javascript'>location.assign('./signout.php');</script>";}
        //Success State
        else{
        	echo "<script>alert('Account deleted.');</script>";
        	session_destroy();
        	echo "<script type='text/javascript'>location.assign('./signlog.php');</script>";
        }
    
    //no databaseerror states
}catch(mysqli_sql_exception $e2){
    echo "<script>alert('ERROR: Incorrect database permissions or disconnection. ');</script>";
    echo "<script type='text/javascript'>location.assign('./signlog.php');</script>";
}
?>

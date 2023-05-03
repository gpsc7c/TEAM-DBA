<?php session_start();
include '../Scorepage/scoreDatabaseFunctions.php';
$ranks = new scoreDatabaseFunctions();
$name = $_SESSION['username'];
$pass = $_SESSION["password"];
$salt = "fractio3_dba";
$pass_encrypted = sha1($pass.$salt);

try{
    
        //fire login function
        #$sql = $ranks->logIn($ranks->dbconn, $name,$pass);
        $sql= $ranks->deleteUser($ranks->dbconn, $name, $pass_encrypted);
        //in cases where login successful and no error out
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
    
    //error states
}catch(mysqli_sql_exception $e2){
    echo "<script>alert('ERROR: Incorrect database permissions or disconnection. ');</script>";
    echo "<script type='text/javascript'>location.assign('./signlog.php');</script>";
}
?>

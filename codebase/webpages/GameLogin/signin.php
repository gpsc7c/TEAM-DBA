<?php
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
#$salt = "fractio3_dba";
#$password_encrypted = sha1($password.$salt);

try{
    //fire login function
    $sql = $ranks->logIn($ranks->dbconn, $name,$pass);
    
    //in cases where login successful and no error out
    if(!is_string($sql)){
        $_SESSION['user_name'] = $name;
        $_SESSION['password'] = $pass;
    	echo "<script>alert('Login successful');</script>";
    
    }
    
    //failure states
    else{
    	echo "<script>alert('ERROR:".$sql."');</script>";
    }
    
    //error states
}catch(mysqli_sql_exception $e2){
    echo "<script>alert('ERROR: Incorrect database permissions or disconnection. ');</script>";
}
?>

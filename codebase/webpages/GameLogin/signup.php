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

try {
        $insertUser = $ranks->addNewUser($ranks->dbconn, $name, $pass);
        if (!is_String($insertUser)){
        echo "<script>alert('ERROR: Username already exists');</script>";
        }
        
        else{
        echo "<script>alert('Successful new user addition! Welcome!');</script>";
    }
    
    //error states
    } catch(mysqli_sql_exception $e2){
    echo "<script>alert('ERROR: Incorrect database permissions or disconnection. ');</script>";
}
?>





















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

try {
        if (strlen($name) < 4 || strlen($name) > 49){
            echo "<script>alert('ERROR: Username must be longer than 3 characters and less than 50');</script>";
        }
        else if (strlen($pass) < 4 || strlen($pass) > 49){
            echo "<script>alert('ERROR: Password must be longer than 3 characters and less than 50');</script>";
        }
        else{
            #$insertUser = $ranks->addNewUser($ranks->dbconn, $name, $pass);
            $insertUser = $ranks->addNewUser($ranks->dbconn, $name, $pass_encrypted);
            if (!is_String($insertUser)){
                echo "<script>alert('ERROR: Username already exists');</script>";
               echo "<script type='text/javascript'>location.assign('./signlog.php');</script>";
            }
            
            else{
                
                $_SESSION['username'] = $name;
                $_SESSION['loggedin'] = true;
                
                echo "<script>alert('Successful new user addition! Welcome!');</script>";
               echo "<script type='text/javascript'>location.assign('../index.php');</script>";
            }   
        }
    
    //error states
    } catch(mysqli_sql_exception $e2){
    echo "<script>alert('ERROR: Incorrect database permissions or disconnection. ');</script>";
    echo "<script type='text/javascript'>location.assign('./signlog.php');</script>";
}
?>





















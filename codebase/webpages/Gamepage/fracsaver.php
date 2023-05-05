<?php session_start();
include '../Scorepage/scoreDatabaseFunctions.php';
$ranks = new scoreDatabaseFunctions();
$digits = $_POST['userInput'];
$decimal = $_POST['decimal'];
$divisor = $_POST['divisor'];
$_SESSION['digits'] = $digits;
try{
    
        //fire storage function
        $sql = $ranks->logIn($ranks->dbconn, $digits, $decimal, $divisor);
        //in cases where login successful and no error out
        if(!is_string($sql)){
            
            
            
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
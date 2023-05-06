<?php session_start();
include '../Scorepage/scoreDatabaseFunctions.php';
$ranks = new scoreDatabaseFunctions();
$digits = $_POST['userInput'];
$decimal = $_POST['decimal'];
$divisor = $_POST['divisor'];
$_SESSION['digits'] = $digits;
try{
    
        //fire storage function
        $sql = $ranks->addNewDigits($ranks->dbconn, $digits, $decimal, $divisor);
        //in cases where login successful and no error out
        if(is_string($sql) && $sql == "0"){
        	echo '<script>alert("INPUT successful, First generation of these numbers");</script>';
            $_SESSION['timesgenned'] = 0;
        }
        else if (is_int($sql)){
            echo '<script>alert("INPUT successful, numbers generated before.");</script>';
            $_SESSION['timesgenned'] = $sql;
            
        }
        //failure states
        else{
        	echo "<script>alert('ERROR:".$sql."');</script>";
        	$_SESSION['timesgenned'] = "";
        }
        
    //error states
}catch(mysqli_sql_exception $e2){
    echo "<script>alert('ERROR: Incorrect database permissions or disconnection. ');</script>";
    echo "<script type='text/javascript'>location.assign('./signlog.php');</script>";
}

?>
<?php
$servername = "localhost";
$username = "root";
$password = "VfX!565WW!t552";
$dbname = "scoreboard_dba";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
# Check connection
if(mysqli_connect_errno()) {
    echo "Connection failed";
    exit();
}
echo "Connection successful.";

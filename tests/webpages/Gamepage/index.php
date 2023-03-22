<!DOCTYPE html>
<?php
$servername = "127.0.0.1";
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
#echo "Connection successful.";
?>
<html lang="en">
 <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="style.css" />
</head>
 <body>
    <script src="scripts.js"></script>

    <div class="game">
        <div id="dino"></div>
        <div id="cactus"></div>
    </div>
 </body>
</html>
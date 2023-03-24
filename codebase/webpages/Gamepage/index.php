<!DOCTYPE html>
<?php
$servername = "127.0.0.1";
$username = "root";
$password = "VfX!565WW!t552";
$dbname = "scoreboard_dba";
// Create connection
$dbconn = $mysqli = new mysqli($servername, $username, $password, $dbname);
# Check connection
error_reporting(E_ALL);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
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
    <div>
        <a href="../Homepage/GroupIntroPage.php"><button>Front Page</button></a>
    </div>
    <div>
        <a href="../Scorepage/ScorePage.php"><button>Extended Scoreboard</button></a>
    </div>
 <?php/*
 $username = 'Alan'
 $sql = "INSERT INTO scoreboard_dba.users VALUES (0,2,$username,2, '001001001');";
 if ($dbconn->query($sql) === TRUE) {
     echo "New record created successfully";
 } else {
     echo "Error: " . $sql . "<br>" . $dbconn->error;
 }
 $sql = "SELECT * FROM  scoreboard_dba.users"
 $dbconn->close();*/
 ?>
 </body>
</html>
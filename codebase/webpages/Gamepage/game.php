<!DOCTYPE html>
<?php
include './ScoreServerConnect.php';
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
        <a href="../index.php"><button>Front Page</button></a>
    </div>
    <div>
        <a href="../Scorepage/ScorePage.php"><button>Extended Scoreboard</button></a>
    </div>
 <?php /*
 #This is test code for later insertion of data
 $username = 'test';
 $password = 'password';

 #this line creates the instruction to be sent
 $sql = "INSERT INTO scoreboard_dba.users VALUES (0,2,$username,$password,2,'001001001');";
 #This line sends the instruction, success line can be changed, and sends the error otherwise
 if ($dbconn->query($sql) === TRUE) {
     echo "New user entry created successfully";
 } else {
     echo "Error: " . $sql . "<br>" . $dbconn->error;
 }
 #This id is a line that pulls information
 $sql = "SELECT * FROM  scoreboard_dba.users"
 $dbconn->close();*/
 ?>
<?php
#SET @r=0;
#UPDATE table SET Ranking= @r:= (@r+1) ORDER BY Score DESC;
?>
 </body>
</html>
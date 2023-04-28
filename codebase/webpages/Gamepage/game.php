<?php
session_start();
?>
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
    <!-- HTML canvas element -->
    <div id="canvas-container" class="game-container hide">
        <canvas id="canvas1"></canvas>

        <!-- game assets to be handled with load function to avoid image errors -->
        <img id="cactusImage" class="gameImg" src="./img/cactus.png">
        <img id="dinoLose0" class="gameImg" src="./img/dino-lose-0.png">
        <img id="baseStationary0" class="gameImg" src="./img/base-stationary-1.png">
        <img id="baseRun0" class="gameImg" src="./img/base-run-0.png">
        <img id="baseRun1" class="gameImg" src="./img/base-run-1.png">
        <img id="baseRun2" class="gameImg" src="./img/base-run-2.png">
        <img id="baseRun3" class="gameImg" src="./img/base-run-3.png">
        <img id="baseJump0" class="gameImg" src="./img/base-jump-0.png">
        <img id="baseFall0" class="gameImg" src="./img/base-fall-0.png">
        <img id="baseDuck0" class="gameImg" src="./img/base-duck-0.png">
        <img id="baseDuck1" class="gameImg" src="./img/base-duck-1.png">        
        <img id="baseDuck2" class="gameImg" src="./img/base-duck-2.png">
        <img id="baseDuck3" class="gameImg" src="./img/base-duck-3.png">
        <img id="bg1Layer1" class="gameImg" src="./img/bg1-layer1.png">
        <img id="bg1Layer2" class="gameImg" src="./img/bg1-layer2.png">
        <img id="bg1Layer3" class="gameImg" src="./img/bg1-layer3.png">
        <img id="bg1Layer4" class="gameImg" src="./img/bg1-layer4.png">
    </div>

    <!-- input for number string -->
    <div id="start-container" class="popup options">
        <h3>Select Character</h3>
        <div class="character-select">
        </br>
            <div class="char-image"></div>
            <div class="char-image"></div>
            <div class="char-image"></div>
            <div class="char-image"></div>
        </br>
        </div>
    </br>
        <div class="num-input">
            <label for="rep-digits" class="num-input">
                <h3>Input your repeating digits:</h3>
            </label>
                <input type="number" name="rep-digits" id="user-num" class="user-num-input">
                <p id="invalid-num" class="invisible">Please enter a nonzero number with 1 to 9 digits.</p>
        </br>
                <button id="game-start">START GAME</button>
        </div>
    </div>

    <script type= "module" src="modules/main.js"></script>
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
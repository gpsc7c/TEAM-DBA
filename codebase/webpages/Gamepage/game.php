<?php
session_start();
include '../Scorepage/scoreDatabaseFunctions.php';
$ranks = new scoreDatabaseFunctions();
// if (!isset($_SESSION['username'])){
//     $loggedoutmsg = "You are not currently logged in, your data will not be saved.";
//     echo $loggedoutmsg;
// }else{echo "logged in";}
?>

<!DOCTYPE html>

<html lang="en">
 <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Game</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="gamestyles.css" />
</head>

 <body>
    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="navbar-container">
            <!-- home button/logo -->
            <a href="../index.php" id="home-button">Fraction Runner</a>

            <!-- other navbar items -->
            <ul class="navbar-menu">
                <li class="navbar-item">
                    <!-- SESSION USAGE -->
                    <!-- line below displays username, put it in the navbar -->
                    <p id="user-greet"><?php
                    if (isset($_SESSION["username"])){
                      echo 'Hello, '; echo $_SESSION['username'];
                    }
                    ?></p>
                </li>
                <li class="navbar-item">
                    <?php
                    if (isset($_SESSION["username"])){
                        echo '<a class="navbar-link" href="../GameLogin/signout.php">Account</a>';
                    }
                    else{
                        echo '<a class="navbar-link" href="../GameLogin/signlog.php">Log In</a>';
                    }
                ?>
                </li>
                <li class="navbar-item">
                    <a class="navbar-link" href="../Gamepage/game.php">Play</a>
                </li>
                <li class="navbar-item">
                    <a class="navbar-link" href="../Scorepage/ScorePage.php">Scoreboard</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- HTML canvas element -->
    <div id="canvas-container" class="game-container hide">
        <canvas id="canvas1"></canvas>

        <!-- game assets to be handled with load function to avoid image errors -->
        <img id="cactusImage" class="gameImg" src="./img/cactus.png">
        <!-- CHARACTER 1 IMAGES -->
        <img id="charBAttack0" class="gameImg" src="./img/charb-attack-0.png">
        <img id="charBDuck0" class="gameImg" src="./img/charb-duck-0.png">
        <img id="charBDuck1" class="gameImg" src="./img/charb-duck-1.png">
        <img id="charBDuck2" class="gameImg" src="./img/charb-duck-2.png">
        <img id="charBDuck3" class="gameImg" src="./img/charb-duck-3.png">
        <img id="charBHurt0" class="gameImg" src="./img/charb-hurt-0.png">
        <img id="charBJump0" class="gameImg" src="./img/charb-jump-0.png">
        <img id="charBFall0" class="gameImg" src="./img/charb-jump-1.png">
        <img id="charBRun0" class="gameImg" src="./img/charb-run-0.png">
        <img id="charBRun1" class="gameImg" src="./img/charb-run-1.png">
        <img id="charBRun2" class="gameImg" src="./img/charb-run-2.png">
        <img id="charBRun3" class="gameImg" src="./img/charb-run-3.png">
        <img id="charBStatic0" class="gameImg" src="./img/charb-static-0.png">
        <!-- CHARACTER 2 IMAGES -->
        <img id="charRAttack0" class="gameImg" src="./img/charr-attack-0.png">
        <img id="charRDuck0" class="gameImg" src="./img/charr-duck-0.png">
        <img id="charRDuck1" class="gameImg" src="./img/charr-duck-1.png">
        <img id="charRDuck2" class="gameImg" src="./img/charr-duck-2.png">
        <img id="charRDuck3" class="gameImg" src="./img/charr-duck-3.png">
        <img id="charRHurt0" class="gameImg" src="./img/charr-hurt-0.png">
        <img id="charRJump0" class="gameImg" src="./img/charr-jump-0.png">
        <img id="charRFall0" class="gameImg" src="./img/charr-jump-1.png">
        <img id="charRRun0" class="gameImg" src="./img/charr-run-0.png">
        <img id="charRRun1" class="gameImg" src="./img/charr-run-1.png">
        <img id="charRRun2" class="gameImg" src="./img/charr-run-2.png">
        <img id="charRRun3" class="gameImg" src="./img/charr-run-3.png">
        <img id="charRStatic0" class="gameImg" src="./img/charr-static-0.png">
        <!-- CHARACTER 3 IMAGES -->
        <img id="charVAttack0" class="gameImg" src="./img/charv-attack-0.png">
        <img id="charVDuck0" class="gameImg" src="./img/charv-duck-0.png">
        <img id="charVDuck1" class="gameImg" src="./img/charv-duck-1.png">
        <img id="charVDuck2" class="gameImg" src="./img/charv-duck-2.png">
        <img id="charVDuck3" class="gameImg" src="./img/charv-duck-3.png">
        <img id="charVHurt0" class="gameImg" src="./img/charv-hurt-0.png">
        <img id="charVJump0" class="gameImg" src="./img/charv-jump-0.png">
        <img id="charVFall0" class="gameImg" src="./img/charv-jump-1.png">
        <img id="charVRun0" class="gameImg" src="./img/charv-run-0.png">
        <img id="charVRun1" class="gameImg" src="./img/charv-run-1.png">
        <img id="charVRun2" class="gameImg" src="./img/charv-run-2.png">
        <img id="charVRun3" class="gameImg" src="./img/charv-run-3.png">
        <img id="charVStatic0" class="gameImg" src="./img/charv-static-0.png">
        <!-- OBSTACLES -->
        <img id="jumpObs" class="gameImg" src="./img/jump obs.png">
        <img id="duckObs" class="gameImg" src="./img/duck obs.png">
        <img id="attackObs" class="gameImg" src="./img/attack obs.png">
        <!-- BG IMAGE LAYERS -->
        <img id="bgLayer1" class="gameImg" src="./img/bg-layer1.png">
        <img id="bgLayer2" class="gameImg" src="./img/bg-layer2.png">
        <img id="bgLayer3" class="gameImg" src="./img/bg-layer3.png">
        <img id="bgLayer4" class="gameImg" src="./img/bg-layer4.png">
    </div>

    <!-- input for number string -->
    <div id="start-container" class="popup options">
        <h3 id="charselect-text">Select Character</h3>
        <div class="character-select">
            <div class="characters">
                <img class="char-image" src="./img/charb-static-0.png" id="charblue">
                <img class="char-image" src="./img/charr-static-0.png" id="charred">
                <img class="char-image" src="./img/charv-static-0.png" id="charvio">
            </div>
            <p id="no-char-selected" class="invisible">Please select your character.</p>
        </div>
        <div class="num-input">
            <label for="rep-digits">
                <h3>Input your repeating digits:</h3>
            </label>
                <input type="number" name="rep-digits" id="user-num" class="user-num-input">
                <p id="invalid-num" class="invisible">Please enter a nonzero number with 1 to 9 digits.</p>
                <button id="game-start">START GAME</button>
        </div>
    </div>

    <script type= "module" src="modules/main.js"></script>
 
 </body>
</html>
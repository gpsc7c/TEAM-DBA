<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="homestyle.css">
  </head>
  <body>
    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="navbar-container">
            <!-- home button/logo -->
            <a href="./mainpage.html" id="home-button">Fraction Runner</a>

            <!-- other navbar items -->
            <ul class="navbar-menu">
                <li class="navbar-item">
                    <!-- SESSION USAGE -->
                    <!-- line below displays username, put it in the navbar -->
                    <p><?php
                    if (isset($_SESSION["username"])){
                      echo 'Hello, '; echo $_SESSION['username'];
                    }
                    ?></p>
                </li>
                <li class="navbar-item">
                    <?php
                    if (isset($_SESSION["username"])){
                        echo '<a class="navbar-link" href="./GameLogin/signout.php">Account</a>';
                    }
                    else{
                        echo '<a class="navbar-link" href="./GameLogin/signlog.php">Log In</a>';
                    }
                ?>
                </li>
                <li class="navbar-item">
                    <a class="navbar-link" href="./Gamepage/game.php">Play</a>
                </li>
                <li class="navbar-item">
                    <a class="navbar-link" href="./Scorepage/ScorePage.php">Scoreboard</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- CONCEPT SECTION -->
    <div class="main" id="about">
        <div class="main-container">
            <div class="about-content">
                <h1>WHAT IS FRACTION RUNNER?</h1>
                <h2>Did you know?</h2>
                <div class="concept-txt1">
                    <p>If you divide any number by the same number of 9s...</p>
                    <p>You'll get a repeating decimal with the same digits as the numerator!</p>
                </div>
                <div class="about-img-container1">
                    <img class="concept-gif" src="./division1.gif" alt="123/999">
                    <img class="concept-gif" src="./division2.gif" alt="21693/99999">
                </div>
            </div>
            <div class="about-content">
                <div class="concept-txt1">
                    <p>
                        Fraction Runner is an endless runner game based on this mathematical idea. Select your character, input a series of up to 9 digits, and increase your score by avoiding obstacles as they approach!
                    </p>
                </div>
                <div class="about-img-container">
                    <img class="concept-img" src="./game-options.png" alt="Character select and number input options">
                </div>
            </div>
                <p>If you're interested in learning more about the math behind Fraction Runner and the link between the number 9 and recurring decimals, click <a target="_blank" href="https://www.youtube.com/watch?v=daro6K6mym8">here</a> to watch a video on the topic.
                </p>
                <!-- add a tag to scroll to controls and one for login/scoreboard sections -->
                <p>If you're itching to jump in, scroll to our <a href="#controls">controls</a> section to learn how to play!</p>
                <!-- add a tag to scroll to login/scoreboard section -->
                <p>Interested in the <a href="#log-and-score">scoreboard</a>? Scroll down to learn how to get your name at the top of the rankings!</p>
        </div>
    </div>

    <!-- CONTROLS SECTION -->
    <div class="main" id="controls">
        <div class="alt-container">
            <div class="alt-content">
                <h1>CONTROLS</h1>
                <div class="about-img-container">
                    <img src="./controls demo.gif" alt="Demonstration of game controls" class="controls-gif">
                </div>
                <p>
                    The controls in Fraction Runner are simple. Press the Up Arrow key to jump over red obstacles, press the Down Arrow key to duck under blue obstacles, and press the Enter key to destroy green obstacles.
                </p>
                <p>
                    Press the Space key during gameplay to pause or to restart the game after a game over.
                </p>
            </div>
        </div>
      </div>

      <!-- LOGIN/SCOREBOARD SECTION -->
      <div class="main" id="log-and-score">
        <div class="alt-container">
            <div class="alt-content">
                <h1>HOW DO YOU RANK?</h1>
                <p>
                    Want to see if your name is at the top of the scoreboard? Just trying to keep track of your personal best score? Start by creating an account!
                </p>
                <p>
                    Fraction Runner can be played without creating an account or signing in, but your scores will not be saved.
                </p>
                <p>
                    Check out the rankings <a href="./Scorepage/ScorePage.php">here</a>.
                </p>
                <!-- </p> <a href="./Scorepage/ScorePage.php"><button>Scoreboard</button></a> -->
            </div>
        </div>
      </div>


    <footer class="main">
      <p>&copy; 2023 Game Company. All rights reserved.</p>
    </footer>

  </body>
</html>
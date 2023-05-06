<?php session_start ?>
<!DOCTYPE html>
<?php
include './scoreDatabaseFunctions.php';
$ranks = new scoreDatabaseFunctions();
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>FRACTION RUNNER Scoreboard</title>
        <link rel="stylesheet" href="./scorestyle.css" type="text/css">
        <!--COMMENTED OUT DUE TO NO LONGER BEING NECESSARY <script src="js/scoretable.js"></script>-->
    </head>

    <script><!--Javascript hole goes here--></script>
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
                    <?php echo $_SESSION['username'];?></p>
                </li>
                <li class="navbar-item">
                    <a href="#about" class="navbar-link" id="about-section">About</a>
                </li>
                <li class="navbar-item">
                    <a href="#signlog" class="navbar-link" id="login-section">Login or Sign Up</a>
                </li>
                <li class="navbar-item">
                    <a href="#play" class="navbar-link" id="play-section">Play</a>
                </li>
                <li class="navbar-item">
                    <a href="#scoreboard" class="navbar-link" id="scoreboard-section">Scoreboard</a>
                </li>
            </ul>
        </div>
    </nav>

        <div>
            <a href="../index.php"><button>Front Page</button></a>
        </div>
        <div>
            <a href="../Gamepage/game.php"><button>Extended Scoreboard</button></a>
        </div>
        <table class="scoretable">
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Name</th>
                    <th>Points</th>
                    <th>Repeating String</th>
                </tr>
            </thead>
            <tbody id = "scoreboard">
            <?php
            if ($ranks->ranking->num_rows > 0) {
                // output data of each row
                $i = 1;
                // do not swap the order of the checks in the while statement
                while($i <= 100 && $row = mysqli_fetch_array($ranks->ranking)) {
                    echo "<tr><td>".$row["score_rank"]."</td><td>".$row["user_name"]."</td><td>".$row["user_score"]."</td><td>".$row["digits"]."</td></tr>";
                    $i++;
                }
            } else {echo "0 results";}
            ?>
            </tbody>
        </table>
        <div>
            <a href="../index.php"><button>Front Page</button></a>
        </div>
        <div>
            <a href="../Gamepage/game.php"><button>Play Game</button></a>
        </div>
        <footer>
            <p>
                All rights reserved
            </p>
        </footer>
    </body>
</html>

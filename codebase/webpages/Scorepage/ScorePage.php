<?php session_start() ?>
<!DOCTYPE html>
<?php
include './scoreDatabaseFunctions.php';
$ranks = new scoreDatabaseFunctions();
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Scoreboard</title>
        <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="./scorestyle.css" type="text/css">
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
                    <p id = "user-greet"><?php
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

        <!-- PERSONAL SCOREBOARD -->
        <div class="user-score-container">
            <table class="scoretable">
                <thead>
                    <tr id="table-title1"><th>Your Rank</th></tr>
                    <tr>
                        <th>Rank</th>
                        <th>Name</th>
                        <th>Points</th>
                        <th>Repeating String</th>
                    </tr>
                </thead>
                <tbody id = "scoreboard">
                <?php
                if (isset($_SESSION["username"])){
                    try{
                        $loggedranking = $ranks->userRankingTable($_SESSION["username"]);
                        if (is_string($loggedranking)){
                            echo $loggedranking;
                        }
                        else if (is_null($loggedranking)){
                            echo "irrecoverable error";
                        }
                        else if ($loggedranking->num_rows > 0) {
                            // output data of each row
                            $i = 1;
                            // do not swap the order of the checks in the while statement
                            while($i <= 100 && $row = mysqli_fetch_array($loggedranking)) {
                                echo "<tr><td>".$row["score_rank"]."</td><td>".$row["user_name"]."</td><td>".$row["user_score"]."</td><td>".$row["digits"]."</td></tr>";
                                $i++;
                            }
                        } else {echo "user does not exist";}
                    } catch(mysqli_sql_exception $e){
                    echo $e;
                    }
                }
                else{echo "<tr><td>user is not logged in</td></tr>";}
                ?>
                </tbody>
            </table>
        </div>

        <!-- ALL USERS SCOREBOARD -->
        <div class="all-scores-container"> 
            <table class="scoretable">
                <thead>
                    <tr id="table-title2"><th>Extended Scoreboard</th></tr>
                    <tr>
                        <th>Rank</th>
                        <th>Name</th>
                        <th>Points</th>
                        <th>Repeating String</th>
                    </tr>
                </thead>
                <tbody id = "scoreboard">
                <?php
                $userranking = $ranks->rankingTable();
                if ($userranking->num_rows > 0) {
                    // output data of each row
                    $i = 1;
                    // do not swap the order of the checks in the while statement
                    while($i <= 100 && $row = mysqli_fetch_array($userranking)) {
                        echo "<tr><td>".$row["score_rank"]."</td><td>".$row["user_name"]."</td><td>".$row["user_score"]."</td><td>".$row["digits"]."</td></tr>";
                        $i++;
                    }
                } else {echo "0 results";}
                ?>
                </tbody>
            </table>
        </div>
    <!-- <div> 
        <?php
        if (isset($_SESSION["username"])){
            echo '<a href="../GameLogin/signout.php"><button>Account Maintenance and Log Out</button></a>';
        }
        else{
            echo '<a href="../GameLogin/signlog.php"><button>Log In and Sign Up</button></a>';
        }
        ?>
        <div>
            <a href="../index.php"><button>Front Page</button></a>
        </div>
        <div>
            <a href="../Gamepage/game.php"><button>Play Game</button></a>
        </div>
    </div> -->
    </body>
</html>

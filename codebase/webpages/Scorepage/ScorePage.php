<!DOCTYPE html>
<?php
include './ScoreServerConnect.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>FRACTION RUNNER Scoreboard</title>
        <link rel="stylesheet" href="ScoreStyle.css" type="text/css">
        <script src="js/scoretable.js"></script>
    </head>
    <?php
    /*$scoreboard_fetch[variable, wher] = mysqli_query($mysqli, "SELECT users.user_name, users.user_score, digits, count(t2.user_name) score_rank
    FROM users
    LEFT JOIN users t2 ON t2.user_score >= users.user_score
    WHERE users.user_name='test2'
    GROUP BY user_score, digits;");
    //This is the code to load into the javascript variables (sb stands for scoreboard)
    $sbname = $scoreboard_fetch['user_name'];
    $sbdigits = $scoreboard_fetch['digits'];
    $sbscore = number_format($scoreboard_fetch['user_score']); //number format is required for this*/
    ?>
    <script><!--Javascript hole goes here--></script>
    <body>
        <header>
            <h1>FRACTION RUNNER</h1>
        </header>
        <div>
            <a href="../Homepage/GroupIntroPage.php"><button>Front Page</button></a>
        </div>
        <div>
            <a href="../Scorepage/ScorePage.php"><button>Extended Scoreboard</button></a>
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
            if ($ranking->num_rows > 0) {
                // output data of each row
                $i = 1;
                // do not swap the order of the checks in the while statement
                while($i <= 100 && $row = mysqli_fetch_array($ranking)) {
                    echo "<tr><td>".$row["score_rank"]."</td><td>".$row["user_name"]."</td><td>".$row["user_score"]."</td><td>".$row["digits"]."</td></tr>";
                    $i++;
                }
            } else {
                echo "0 results";
            }
            ?>
            </tbody>
        </table>
        <div>
            <a href="../Homepage/GroupIntroPage.php"><button>Front Page</button></a>
        </div>
        <div>
            <a href="../Gamepage/index.php"><button>Play Game</button></a>
        </div>
        <footer>
            <p>
                All rights reserved
            </p>
        </footer>

    </body>

</html>

<!DOCTYPE html>
<?php
include './scoreDatabaseFunctions.php';
$ranks = new scoreDatabaseFunctions();
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>FRACTION RUNNER Scoreboard</title>
        <link rel="stylesheet" href="ScoreStyle.css" type="text/css">
        <script src="js/scoretable.js"></script>
    </head>

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

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

<html>
    <head>
        <meta charset="UTF-8">
        <title>FRACTION RUNNER Scoreboard</title>
        <link rel="stylesheet" href="ScoreStyle.css" type="text/css">
        <script src="js/scoretable.js"></script>
    </head>
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

<?php
$servername = "127.0.0.1";
$username = "root";
$password = "VfX!565WW!t552";
$dbname = "scoreboard_dba";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
# Check connection
if(mysqli_connect_errno()) {
    echo "Connection failed";
    exit();
}
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
        <footer>
            <p>
                All rights reserved
            </p>
        </footer>
    </body>
</html>

<?php session_start() ?>
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
    </head>

    
    <body>
        <header>
            <h1>FRACTION RUNNER</h1>
        </header>
        <div> 
        <?php
        if (isset($_SESSION["username"])){
            echo '<a href="../GameLogin/signout.php"><button>Account Maintenance and Log Out</button></a>';
        }
        else{
            echo '<a href="../GameLogin/signlog.php"><button>Log In and Sign Up</button></a>';
        }
        ?>
        </div>
        <div>
            <a href="../index.php"><button>Front Page</button></a>
        </div>
        <div>
            <a href="../Gamepage/game.php"><button>Play the Game</button></a>
        </div>
        <table class="scoretable">
            <thead>
                <tr><th>Your Rank</th></tr>
                <tr>
                    <th>Rank</th>
                    <th>Name</th>
                    <th>Points</th>
                    <th>Repeating String</th>
                </tr>
            </thead>
            <tbody id = "scoreboard">
            <?php
            try{
            $loggedranking = $ranks->userRankingTable("test");
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
            ?>
            </tbody>
        </table>
        <table class="scoretable">
            <thead>
                <tr><th>Extended Scoreboard</th></tr>
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
        <div> 
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
        <footer>
            <p>
                All rights reserved
            </p>
        </footer>
    </body>
</html>

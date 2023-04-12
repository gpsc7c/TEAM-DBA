<body>
<div id = 'scoreboardcontainer'>
    <?php
    $servername = "127.0.0.1";
    $sqlusername = "root";
    $sqlpassword = "VfX!565WW!t552";
    $dbname = "scoreboard_dba";
    // Create connection
    // username and password here are for the sql server
    $dbconn = $mysqli = new mysqli($servername, $sqlusername, $sqlpassword, $dbname);
    # Check connection
    error_reporting(E_ALL);
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    #echo "Connection successful.";

    $ranking = mysqli_query($mysqli, "SELECT user_name, user_score\n"
        . "FROM scoreboard_dba.users\n"
        . "WHERE user_score = (SELECT MAX(user_score) FROM scoreboard_dba.users WHERE user_score< (SELECT MAX(user_score) FROM scoreboard_dba.users WHERE user_score <(SELECT MAX(user_score) FROM scoreboard_dba.users)))");
    ?>
    <ul>
        <li><a href="#scoreboard" title = "Point scoreboards">Scoreboards</a></li>
        <li><a href="#Tour_boards" title = "Tournament scoreboards" class = "tbr">Tournament</a></li>
    </ul>

    <div id="scoreboard">
        <div class = "scoreboardtitles">
            <div class = "player_score_rankinfl2">Rank</div>
            <div class = "player_score_usnamefl2">Username</div>
            <div class = "player_score_charnamefl2">Character</div>
            <div class = "player_score_pointfl2">Points</div>
        </div>
        <br />
        <hr />
        <?php
        $scoreboard_query = mysqli_query($mysqli, "SELECT * FROM scoreboard_dba.users ORDER BY user_score DESC");
        while($scoreboard_fetch = mysqli_fetch_array($scoreboard_query)){
            ?>
            <div class="global_container_score_class"> <!--Start generating from here-->
                <div class = "scoreboard_1l">
                    <div class = "player_rank">1st</div>
                    <div class = "player_name"><?php echo $scbdname = $scoreboard_fetch['user_name'];?></div>
                </div>
                <div class = "scoreboard_2r">
                    <div class = "player_charname"><?php echo $scbddspname = $scoreboard_fetch['digits'];?></div>
                    <div class = "player_points"><?php echo $scbdpoints = number_format($scoreboard_fetch['user_score']);?></div>
                </div>
                <div class = "clear"></div>
            </div>
            <?php
        }
        ?>
    </div>
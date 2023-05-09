<?php session_start(); 
include '../Scorepage/scoreDatabaseFunctions.php';
?>
<!DOCTYPE html>
<html>
<head>
	<link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="./signoutstyle.css">
	<title>Log Out and Account Maintenance</title>
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



	<!-- PAGE CONTENT -->
	<div class="page-container">
		<h1 class="page-header">Account Maintenance</h1>
		<div class="content-container">
			<form action="./logout.php" method="post">
			<h2>Sign Out</h2>
			<button type="submit" name="logOut">Log Out</button>
			</form>
		</div>
		<div class="content-container">
			<form action="./changepass.php" method="post">
			<h2>Change Password</h2>
			<input type="password" name="oldpassword" placeholder="Current Password">
			<input type="password" name="newpassword" placeholder="New Password">
			<button type="submit" name="changePass">Change Password</button>
			</form>
		</div>
		<div class="content-container">
			<form action="./areyousure.php" method="post">
			<h2>Delete Account</h2>
			<input type="password" name="password" placeholder="Password">
			<button type="submit" name="deleteAccount">Delete Account</button>
			</form>
		</div>
	</div>
</body>
</html>
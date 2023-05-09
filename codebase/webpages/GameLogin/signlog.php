<?php
    session_start();
    include 'connection.php';
    if(isset($_SESSION['username'])){
        echo "<script type='text/javascript'>location.assign('../index.php');</script>";
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sign Up and Login</title>
	<link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="./style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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


<div class="container" id="container">
<div class="form-container sign-up-container">

<form action="./signup.php" method="post">
	<h1>Create Account</h1>
	<input type="text" name="name" placeholder="Username">
	<input type="password" name="password" placeholder="Password">
	<button type="submit" name="signup">SignUp</button>
</form>
</div>
<div class="form-container sign-in-container">
	<form action="./signin.php" method="post">
		<h1>Sign In</h1>
	<input type="text" name="name" placeholder="Username">
	<input type="password" name="password" placeholder="Password">
	<!-- Cut because we do not have high enough level encryption to take email addresses <a href="#">Forgot Your Password</a>-->

	<button type="submit" name="signIn">Sign In</button>
	</form>
</div>
<div class="overlay-container">
	<div class="overlay">
		<div class="overlay-panel overlay-left">
			<h1>Welcome Back!</h1>
			<p>Login to track your scoreboard rank!</p>
			<button class="ghost" id="signIn">Sign In</button>
		</div>
		<div class="overlay-panel overlay-right">
			<h1>Hello</h1>
			<p>Enter your details and start playing!</p>
			<button class="ghost" id="signUp">Sign Up</button>
		</div>
	</div>
</div>
</div>
<?php
    #include 'signin.php';
	#include 'signup.php';
?>

<script type="text/javascript">
    
	const signUpButton = document.getElementById('signUp');
	const signInButton = document.getElementById('signIn');
	const container = document.getElementById('container');
    
	signUpButton.addEventListener('click', () => {
		container.classList.add("right-panel-active");
	});
	signInButton.addEventListener('click', () => {
		container.classList.remove("right-panel-active");
	
	});
	
</script>
</body>
</html>

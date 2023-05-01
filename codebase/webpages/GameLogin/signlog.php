<?php
    session_start();
    include 'connection.php';
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
        echo "<script type='text/javascript'>location.assign('../index.php');</script>";
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>SignUp and Login</title>
	<link rel="stylesheet" type="text/css" href="./style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

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
	<span>or use your account</span>
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
			<p>To keep connected with us please login with your personal info</p>
			<button class="ghost" id="signIn">Sign In</button>
		</div>
		<div class="overlay-panel overlay-right">
			<h1>Hello</h1>
			<p>Enter your details and start Playing</p>
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

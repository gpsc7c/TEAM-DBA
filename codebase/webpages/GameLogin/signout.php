<?php session_start(); 
include '../Scorepage/scoreDatabaseFunctions.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Log Out and Account Maintenance</title>
</head>
<body>
    <h1>
        Log Out and Account Maintenance
    </h1>
    <div>
        <form action="./logout.php" method="post">
		<h1>Sign Out</h1>
	<button type="submit" name="logOut">Log Out</button>
	</form>
    </div>
    <div>
        <form action="./changepass.php" method="post">
		<h1>Change Password</h1>
	<input type="password" name="oldpassword" placeholder="Current Password">
	<input type="password" name="newpassword" placeholder="New Password">
	<button type="submit" name="changePass">Change Password</button>
	</form>
    </div>
    <div>
        <form action="./areyousure.php" method="post">
		<h1>Delete Account</h1>
	<input type="password" name="password" placeholder="Password">
	<button type="submit" name="deleteAccount">Delete Account</button>
	</form>
    </div>
</body>
</html>
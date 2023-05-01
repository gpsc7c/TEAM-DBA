<?php session_start(); 
include '../Scorepage/scoreDatabaseFunctions.php';
$name = $_SESSION['username'];
$_SESSION["password"] = $_POST["password"];?>
<html>
    <body></body>
    <script type="text/javascript">
    var ask = window.confirm("Are you sure you want to delete your account? (This cannot be undone.)");
        if (ask) {
            window.location.href = "./deleter.php";
        }
        else {
            window.location.href = "./signout.php";
        }
    </script>
</html>
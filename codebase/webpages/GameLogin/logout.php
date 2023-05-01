<?php session_start();
session_unset();
session_destroy();
echo "<script type='text/javascript'>location.assign('./signlog.php');</script>";
?>
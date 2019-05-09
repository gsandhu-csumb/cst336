<?php
session_start();
unset($_SESSION['id']);
//session_destroy();
header('Location: login.php'); //taking user back to login screen
?>
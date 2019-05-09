<?php
session_start();
session_destroy();
header('Location: login.php'); //taking user back to login screen
?>
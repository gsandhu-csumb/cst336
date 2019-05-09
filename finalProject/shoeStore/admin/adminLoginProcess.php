<?php
session_start(); //starts or resumes an existing session

//print_r($_POST); //for debugging purposes, display the content of the $_POST array

//include '../../inc/dbConnection.php';

//username: admin
//password:admin

$conn = getDatabaseConnection("");

$username = $_POST['username'];
$password = sha1($_POST['password']);

$sql = "SELECT * FROM om_admin WHERE username = :username AND password = :password";

$namedParameters = array();
$namedParameters[':username'] = $username;
$namedParameters[':password'] = $password;
$stmt = $conn->prepare($sql);
$stmt->execute($namedParameters);
$record = $stmt->fetch(PDO::FETCH_ASSOC); //we are expecting ONLY one record, so we use fetch instead of fetchAll

// print_r($record);
 
 if (empty($record)) {
    //  $message = "Invalid Login";
    //  echo "<script type='text/javascript'>alert('$message');</script>";
     header('location: adminLogin.html'); //redirecting to a new file
     
 }  else {
    //echo $record[0]['firstName']; //using fetchAll
    //echo $record['firstName'] . " " . $record['lastName'] ; //using fetch
    $_SESSION['adminName'] = $record['firstName'] . " " . $record['lastName'];
    header('location: admin.php'); //redirecting to a new file
}
?>
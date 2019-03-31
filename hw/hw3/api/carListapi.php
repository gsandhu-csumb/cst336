<?php
$host = "localhost"; // url to database
$dbname = "homework3";
$username = "root";
$password = "";
// Establishing a connection
$dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
// Setting errorhandling to exception
$dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "SELECT * FROM mp_product ORDER BY productPrice";
$stmt = $dbConn -> prepare($sql);  //$connection MUST be previously initialized, $dbConn = $connection
$stmt->execute();
$records = $stmt->fetchAll(PDO::FETCH_ASSOC); //use fetch for one record, fetchAll for multiple
//print_r($records); // displays array content
echo json_encode($records);
//echo $records[0]['productName'];
?>
<?php
include 'dbConnection.php';
$dbConn = getDatabaseConnection("homework3");
$sql = "SELECT * FROM mp_product ORDER BY productPrice";
$stmt = $dbConn -> prepare($sql);  //$connection MUST be previously initialized, $dbConn = $connection
$stmt->execute();
$records = $stmt->fetchAll(PDO::FETCH_ASSOC); //use fetch for one record, fetchAll for multiple
//print_r($records); // displays array content
echo json_encode($records[rand(0, count($records) - 1)]);
?>
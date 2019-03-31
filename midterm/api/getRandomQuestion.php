<?php
$host = "localhost"; // url to database
$dbname = "midterm";
$username = "root";
$password = "";
// Establishing a connection
$dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
// Setting errorhandling to exception
$dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "SELECT * FROM m_question ORDER BY questionId";
$stmt = $dbConn -> prepare($sql);  //$connection MUST be previously initialized, $dbConn = $connection
$stmt->execute();
$records = $stmt->fetchAll(PDO::FETCH_ASSOC); //use fetch for one record, fetchAll for multiple
//print_r($records); // displays array content
echo json_encode($records[rand(0, count($records) - 1)]);
?>
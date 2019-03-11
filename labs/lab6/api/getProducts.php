<?php


$host = "localhost";
$dbname = "ottermart";
$username = "root";
$password = "";

$dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);



$dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "SELECT * FROM om_product ORDER BY price LIMIT 10";
$stmt = $dbConn -> prepare($sql);  //$connection MUST be previously initialized
$stmt->execute();
$records = $stmt->fetchAll(PDO::FETCH_ASSOC); //use fetch for one record, fetchAll for multiple

//print_r($records); //displays array info/content (For Debugging)

//echo $records[0]['productName']

echo json_encode($records);

?>
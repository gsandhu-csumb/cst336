<?php
$host = "localhost"; // url to database
$dbname = "midterm";
$username = "root";
$password = "";
// Establishing a connection
$dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
// Setting errorhandling to exception
   $conn = getDatabaseConnection("ottermart");
    $sql = "SELECT * FROM m_question ORDER BY questionId";;
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($records);
?>
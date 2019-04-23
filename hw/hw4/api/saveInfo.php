<?php
include 'dbConnection.php';
    $conn = getDatabaseConnection("moviesDatabase");
    $arr = array();
    $arr[":title"] = $_GET["keyword"];
    $sql = "INSERT INTO data ( `title`) 
    VALUES (:title)";
    $stmt = $conn->prepare($sql);
    $stmt->execute($arr);
    $records = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($records);
?>
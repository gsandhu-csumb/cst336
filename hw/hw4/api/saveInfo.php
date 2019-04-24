<?php
include 'dbConnection.php';
    $conn = getDatabaseConnection("moviesDatabase");
    $arr = array();
    $arr[":title"] = $_GET["Title"];
    $arr[":year"] = $_GET["Year"];
    $arr[":genre"] = $_GET["Genre"];
    $arr[":director"] = $_GET["Director"];
    $arr[":rating"] = $_GET["Rating"];
    $sql = "INSERT INTO movies_list ( `Title`, `Year`, `Genre`, `Director`, `Rating` ) VALUES ( :title, :year, :genre, :director, :rating)";
    $stmt = $conn->prepare($sql);
    $stmt->execute($arr);
    $records = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($records);
?>
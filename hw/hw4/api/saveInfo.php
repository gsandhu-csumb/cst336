<?php
include 'dbConnection.php';
    $conn = getDatabaseConnection("moviesDatabase");
    $title = $_GET['title'];
    // $arr = array();
    // $arr[":title"] = $_GET["title"];
    // $arr[":year"] = $_GET["Year"];
    // $arr[":genre"] = $_GET["Genre"];
    // $arr[":director"] = $_GET["Director"];
    // $arr[":rating"] = $_GET["Rating"];
    //$sql = "INSERT INTO moviesList ('productName') VALUES (':title')";
    $sql = "INSERT INTO moviesList (productName)
            VALUES ('$title')";
    $stmt = $conn->prepare($sql);
    $stmt->execute($arr);
    $records = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($records);
    //echo $arr[":title"];
?>
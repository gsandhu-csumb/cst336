<?php
include 'dbConnection.php';
    $conn = getDatabaseConnection("c9");
    $email = $_GET['email'];
    $points = $_GET['points'];
    $taken = $_GET['taken'];
    $sql = "INSERT INTO quiz (email, score , taken)
            VALUES ('$email', '$points', '$taken')";
    $stmt = $conn->prepare($sql);
    $stmt->execute($arr);
    $records = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($records);
    //echo $arr[":title"];
?>
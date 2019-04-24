<?php
    include 'dbConnection.php';
    $conn = getDatabaseConnection("moviesDatabase");
    $sql = "SELECT * FROM `title` ORDER BY `year` ASC"; 
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($records);
?>
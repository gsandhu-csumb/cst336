<?php
    include 'dbConnection.php';
    $conn = getDatabaseConnection("moviesDatabase");
    $sql = "SELECT * FROM `title` ORDER BY `id` ASC"; 
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($records);
?>
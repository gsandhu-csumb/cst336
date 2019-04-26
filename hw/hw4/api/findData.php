<?php
    include 'dbConnection.php';
    $conn = getDatabaseConnection("moviesDatabase");
    $sql = "SELECT * FROM moviesList ORDER BY productID DESC LIMIT 1"; 
    //SELECT * FROM Customers ORDER BY Country DESC;
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($records);
?>
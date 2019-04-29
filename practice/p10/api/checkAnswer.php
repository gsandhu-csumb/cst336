<?php
//receive email and score from the quiz
//1. Get latest score based on email
//2. If record found, first display it in JSON format, then update record
//3. If record not found, insert a new record for that email
    include 'dbConnection.php';
    $conn = getDatabaseConnection("c9");
    $email = $_GET['email'];
    $sql = "SELECT * FROM quiz WHERE email = $email"; 
    $sql = "SELECT * FROM quiz ORDER BY email DESC"; 
    //SELECT * FROM Customers ORDER BY Country DESC;
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($records);
?>
<?php
    include '../../../inc/dbConnection.php';
    $conn = getDatabaseConnection("csumb_poll");
    $option1 = "Strongly Disagree";
    $option2 = "Disagree";
    $option3 = "Neutral";
    $option4 = "Agree";
    $option5 = "Strongly Agree";
    $arr = array();
    $[":choice"] = $_GET["choice"];
    if($[":choice"] == $option1){
        $sql = "INSERT INTO poll_response (`option1`) VALUES (:choices)";
    }
    if($[":choice"] == $option2){
        $sql = "INSERT INTO poll_response (`option2`) VALUES (:choices)";
    }
    if($[":choice"] == $option3){
        $sql = "INSERT INTO poll_response (`option3`) VALUES (:choices)";
    }
    if($[":choice"] == $option4){
        $sql = "INSERT INTO poll_response (`option4`) VALUES (:choices)";
    }
    if($[":choice"] == $option5){
        $sql = "INSERT INTO poll_response (`option5`) VALUES (:choices)";
    }
    $stmt = $conn->prepare($sql);
    $stmt->execute($arr);
    $records = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($records);
?>
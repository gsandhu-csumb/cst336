<?php

    include '../../../inc/dbConnection.php';
    $conn = getDatabaseConnection("ottermart");
    
    $arr = array();
    
    $arr[":productName"] = $_GET["productName"];
    $arr[":productDescription"] = $_GET["productDescription"];
    $arr[":productImage"] = $_GET["productImage"];
    $arr[":productPrice"] = $_GET["productPrice"];
    $arr[":catId"] = $_GET["catId"];
    $sql = "INSERT INTO om_product ( `productName`, `productDescription`, `productImage`, `productPrice`, `catId`) 
    VALUES (:productName, :productDescription, :productImage, :productPrice, :catId)";
    $stmt = $conn->prepare($sql);
    $stmt->execute($arr);
?>
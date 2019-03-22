<?php
include '../../../inc/dbConnection.php';
$conn = getDatabaseConnection("ottermart");
$product = $_GET['product'];
$namedParameters = array();
//This query works BUT it allows SQL INJECTION (because it's using single quotes)
//$sql = "SELECT * FROM `om_product` WHERE productName LIKE '%$product%'";
$sql = "SELECT * FROM om_product WHERE 1"; //Retrieves ALL records
if (!empty($product)) { //user entered a product keyword
    $sql .=  " AND productName LIKE :product";
    $namedParameters[":product"] = "%$product%";
}
$description = $_GET['description'];
if (!empty($description)) { //user entered a product keyword
    $sql .=  " AND productDescription LIKE :description";
    $namedParameters[":description"] = "%$description%";
}
if (!empty($_GET['category'])) { //user entered a product keyword
    $sql .=  " AND catId = :categoryId";
    $namedParameters[":categoryId"] = $_GET['category'];
}
if (!empty($_GET['priceFrom'])) { //user entered a product keyword
    $sql .=  " AND productPrice >= :priceFrom";
    $namedParameters[":priceFrom"] = $_GET['priceFrom'];
}
if (!empty($_GET['priceTo'])) { //user entered a product keyword
    $sql .=  " AND productPrice <= :priceTo";
    $namedParameters[":priceTo"] = $_GET['priceTo'];
}
if (isset($_GET['orderBy'])) { //user entered a product keyword
    if($_GET['orderBy'] == "price"){
        $sql .= " ORDER BY productPrice";
    }
    else if($_GET['orderBy'] == "name"){
        $sql .= " ORDER BY productName";
    }
}
$stmt = $conn -> prepare($sql);  //$connection MUST be previously initialized
$stmt->execute($namedParameters);
$records = $stmt->fetchAll(PDO::FETCH_ASSOC); //use fetch for one record, fetchAll for multiple
//print_r($records); //debugging    
echo json_encode($records);
?>
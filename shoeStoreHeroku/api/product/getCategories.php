<?php
header('Content-Type: application/json');

include("../common.php");
include("../db/Database.php");


// This gave an error when calling for some reason...
if(!isRequestOf("GET"))
    die();
    
$productDao = Database::getProductDao();
$product = $productDao->getCategories();
if($product == null) {
    $product = ["success" => false];    
}

echo json_encode($product);
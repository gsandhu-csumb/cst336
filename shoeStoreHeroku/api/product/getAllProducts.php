<?php
header('Content-Type: application/json');


include("../common.php");
include("../db/Database.php");

if(!isRequestOf("GET"))
    die();
    
$productDao = Database::getProductDao();
$product = $productDao->findAllProducts();
if($product == null)
    $product = ["success" => false];
echo json_encode($product);
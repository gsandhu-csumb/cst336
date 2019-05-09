<?php
header('Content-Type: application/json');

include("../common.php");
include("../db/Database.php");

if(!isRequestOf("POST") || !hasAllParams($_POST, ["id"]))
    die();

$success = false;
$reason = "No error.";
$productDao = Database::getProductDao();

$product = $productDao->findById($_POST[id]);
$productDao->delete($product);
$success = true;

echo json_encode(["success" => $success, "reason" => $reason]);
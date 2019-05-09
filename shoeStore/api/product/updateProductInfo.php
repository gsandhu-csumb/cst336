<?php
header('Content-Type: application/json');

include("../common.php");
include("../db/Database.php");

if(!isRequestOf("POST") || !hasAllParams($_POST, ["id",  "name", "color", "description","thumbnail", "price", "catId"]))
    die();

$success = false;
$reason = "No error.";
$productDao = Database::getProductDao();
if($_POST["name"] === "" || $_POST["price"] === ""){
    $reason = "Empty name or price provided.";
} else {
    $product = new Product;
    $product->id = $_POST['id'];
    $product->name = $_POST["name"];
    $product->color = $_POST["color"];
    $product->description = $_POST["description"];
    $product->thumbnail = $_POST["thumbnail"];
    $product->price = $_POST["price"];
    $product->catId = $_POST["catId"];
    $productDao->update($product);
    $success = true;
}
echo json_encode(["success" => $success, "reason" => $reason]);
<?php
header('Content-Type: application/json');

include("../common.php");
include("../db/Database.php");

if(!isRequestOf("GET") || !hasAllParams($_GET, ["id"]))
    die();
   
session_start();
if(!isset($_SESSION["cart"])){
    $_SESSION["cart"] = array();
}


if(in_array($_GET["id"], $_SESSION["cart"])){
    echo json_encode(["success" => false, "message" => "Item already in cart."]);
} else {
    $_SESSION["cart"][] = $_GET["id"];
    echo json_encode(["success" => true]);
}
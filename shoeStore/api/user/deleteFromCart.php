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
    $cart = $_SESSION['cart'];
    $pos = array_search($_GET['id'], $cart);
    
    unset($cart[$pos]);
    
    $cart = array_values($cart);
    
    $_SESSION['cart'] = $cart;
} 
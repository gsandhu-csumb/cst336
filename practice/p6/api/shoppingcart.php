<?php

$products = array();
$products["products"] = "Flip-flop Sandals";
$products["prices"] = "30";
$productsArray = array();
array_push($productsArray, $products);
$products["products"] = "Beach Towel";
$products["prices"] = "40";
array_push($productsArray, $products);
$products["products"] = "Sunscreen";
$products["prices"] = "20";
array_push($productsArray, $products);

echo json_encode($productsArray[rand(0,1)]);









?>
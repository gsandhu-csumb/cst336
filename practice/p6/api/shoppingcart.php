<?php
$products = array();
$productsArray = array();
$products["product"] = "Microfiber Beach Towel";
$products["price"] = 40;
$products["quantity"] = 2;
array_push($productsArray, $products);
$products["product"] = "Flip-flop Sandals";
$products["price"] = 30;
$products["quantity"] = 5;
array_push($productsArray, $products);
$products["product"] = "Sunscreen 80SPF";
$products["price"] = 25;
$products["quantity"] = 3;
array_push($productsArray, $products);
$products["product"] = "Plastic Flying Disc";
$products["price"] = 15;
$products["quantity"] = 4;
array_push($productsArray, $products);
$products["product"] = "Beach Umbrella";
$products["price"] = 75;
$products["quantity"] = 1;
array_push($productsArray, $products);
echo json_encode($productsArray[rand(0,4)]);
?>
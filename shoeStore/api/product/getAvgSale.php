<?php
header('Content-Type: application/json');

include("../common.php");
include("../db/Database.php");

if(!isRequestOf("GET"))
    die();
    
$purchasesDao = Database::getPurchasesDao();
echo json_encode(["price" => $purchasesDao->findByAvg()]);
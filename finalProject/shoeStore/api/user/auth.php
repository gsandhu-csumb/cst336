<?php
header('Content-Type: application/json');

include("../common.php");
include("../db/Database.php");

if(!isRequestOf("POST") || !hasAllParams($_POST, ["username", "password"]))
    die();

$user = Database::getUserDao()->findByName($_POST["username"]);
$localHashword = hash("sha256", $_POST["password"]);

$success = false;
if($user->hashword === $localHashword){
    session_start();
    $_SESSION["id"] = $user->id;
    $success = true;
}
echo json_encode(["success" => $success]);
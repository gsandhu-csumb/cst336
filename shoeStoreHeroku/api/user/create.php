<?php
header('Content-Type: application/json');

include("../common.php");
include("../db/Database.php");

if(!isRequestOf("POST") || !hasAllParams($_POST, ["username", "password"]))
    die();
   
$success = false; 
$reason = "No error.";
$userDao = Database::getUserDao();

if($_POST["username"] === "" || $_POST["password"] === ""){
    $reaosn = "Empty username or password.";
} elseif($userDao->findByName($_POST["username"]) === false){
    $reason = "Username already exists.";
} else {
    // create new user obj
    $user = new User;
    $user->username = $_POST["username"];
    $user->hashword = hash("sha256", $_POST["password"]);
    // insert our new user into the db
    $userDao->insert($user);
    
    // create and start new session
    session_start();
    $_SESSION["id"] = $user->id;
}

echo json_encode(["success" => $success, "reason" => $reason]);
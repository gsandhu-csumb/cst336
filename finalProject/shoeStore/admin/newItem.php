<?php
include("../api/db/Database.php");
// start session to access session data
session_start();
$user = null;
if(isset($_SESSION["id"])){
    // find user in db
    $user = Database::getUserDao()->findById($_SESSION["id"]);
    // if no user was found or if user is not admin, return them
    if($user == null || !$user->isAdmin()){
        header("Location: login.php");
        die();
    }
} else {
    // found no valid session user id, take them back 
    header("Location: login.php");
    die();
}
// if we reach here, user is an admin and is logged in
include("../shell/top.php");
?>
<div class="navigation-bar">
    <a href="/admin/">＋ Admin Home</a>
    <a href="/admin/newItem.php">＋ New Item</a>
</div>
<!DOCTYPE html>
<html>
    <head>
        <title> </title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        
        <style>
        
            #successMessage {
                visibility: hidden;
                font-size: 2em;
                color: green;
            }
        
        </style>
    </head>
    
    <body>
        <h1>Add new product</h1>
        
        <form method='post' action="javascript:void(0);">
            Enter Product Name:<input type="text" id = "productName" size="50">
            <br>
            Enter Product Color:<input type="text" id = "productColor" size="50">
            <br>
            Enter Product Description: <textarea id="productDescription" cols="40" rows="3"></textarea>
            <br>
            Product Image:<input type = "text" id = "productImage">
            <br/>
            Product Price: <input type="text" id="productPrice">
            <br/>
            Categories Name: <Select id = "catId">
            <Option> Select One </Option>
            </Select><br>
            
            <button id="submitButton">Add Product</button>
        </form>    
        
        <form action="index.php">
        <button>Go Back</button>
        </form><br><br>
        
        <span id="totalProducts"></span>
    </body>
    
    
    <script>
        /* global $ */
        $.ajax({
            type: "GET",
            url: "../api/product/getCategories.php",
            dataType: "json",
            success: function(data, status) {
                data.forEach(function(key) {
                $("#catId").append("<option value=" + key["catId"] + ">" + key["catName"] + "</option>");
                });
            }
        }); 
                
        $("#submitButton").on("click", function(){
                   $.ajax({
                    type: "POST",
                    url: "../api/product/create.php",
                    dataType: "json",
                    data : {"name": $("#productName").val(),
                        "color" : $("#productColor").val(),
                        "description": $("#productDescription").val(),
                        "thumbnail": $("#productImage").val(),
                        "price": $("#productPrice").val(),
                        "catId": $("#catId").val()
                    },
                    success: function(data, status) {
                        alert("Added item.");
                        window.location = "index.php";
                    }
                }); 
        });
    </script>
</html>
<?php include("../shell/bottom.php"); ?>
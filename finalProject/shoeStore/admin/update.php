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
//$item = Database::getProductDao()->findById($_GET["id"]);
include("../shell/top.php");
?>

<div class="navigation-bar">
    <a href="/admin/">＋ Admin Home</a>
    <a href="/admin/newItem.php">＋ New Item</a>
</div>

<script>
    
    $.ajax({
        type: "GET",
        url: "../api/product/getCategories.php",
        dataType: "json",
        success: function(data, status) {
            data.forEach(function(key) {
            $("#catId").append("<option value=" + key["catId"] + ">" + key["catName"] + "</option>");
            });
            console.log("Got Category");
            getProductInfo();
        }
    }); 
    
    
    function getProductInfo() {
        $.ajax({
            type: "GET",
            url: "../api/product/getById.php",
            dataType: "json",
            data:{"id": <?=$_GET['productId']?>},
            success: function(data, status) {
                $("#productName").val(data.name);
                $("#productColor").val(data.color);
                $("#productDescription").val(data['description']);
                $("#productPrice").val(data.price);
                $("#productImage").val(data.thumbnail);
                $("#catId").val(data.catId).change();
            }
        });
    }
    
    $(document).ready(function() {
        $("#updateProduct").on("click", function() {
            $.ajax({
                type: "POST",
                url: "../api/product/updateProductInfo.php",
                dataType: "json",
                data:{"id": <?=$_GET['productId']?>,
                    "name" : $("#productName").val(),
                    "color" : $("#productColor").val(),
                    "thumbnail" : $("#productImage").val(),
                    "description" : $("#productDescription").val(),
                    "price" : $("#productPrice").val(),
                    "catId" : $("#catId").val(),
                },
                success: function(data, status) {
                    window.location = "index.php";
                }
            }); 
        }); //On updateProduct Click 
    }); //Doc Ready

    
</script>

<body>
    <h1> Update Product</h1>
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
    
    <button id="updateProduct">Update Product</button>
    
    <span id="updated"></span>

</body>

<?php include("../shell/bottom.php") ?>
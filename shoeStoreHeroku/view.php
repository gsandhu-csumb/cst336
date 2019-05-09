<?php 
include("shell/top.php");
include("api/db/Database.php");

if(!isset($_GET["id"])){
    header("Location: catalog.php");
    die();
}
session_start();
if(!isset($_SESSION["cart"])){
    $_SESSION["cart"] = array();
}
$inCart = in_array($_GET["id"], $_SESSION["cart"]);
$item = Database::getProductDao()->findById($_GET["id"]);
?>

<script>
/* global $ */
$(function(){
    $("#add-to-cart").click(function(event){
        $.ajax({
            url: "api/user/addToCart.php",
            data: { id: "<?= $item->id ?>" },
            dataType: "json",
            success: function(data, status){
                if(data["success"] === true){
                    $("#add-to-cart")
                        .html("Added to cart.")
                        .addClass("success")
                } else {
                    $("#add-to-cart")
                        .html(data["message"])
                        .addClass("failed")
                        .addClass("shake")
                    $("#add-to-cart").bind("webkitAnimationEnd mozAnimationEnd animationend", function(){
                        $(this).removeClass("shake")  
                    })
                }
                $("#add-to-cart")
                    .addClass("disabled")
                    .off();
            }
        });
    });
});
</script>

<div id="view-model">
    <img src="<?= $item->thumbnail ?>">
    <div id="info">
        <span class="product-name"><?= $item->name ?></span>
        <br/>
        <span class="product-info"><?= $item->description ?></span>
        <br/>
        <span class="product-info">$<?= $item->price ?></span>
        <br/>
        <div id="cart-button">
            <button 
                id="add-to-cart" 
                <?= $inCart ? 'class="disabled failed"' : ""?>>
                <?= $inCart ? "Item already in cart." : "Add to cart" ?>
            </button>
        </div>
    </div>
</div>
<?php include("shell/bottom.php") ?>
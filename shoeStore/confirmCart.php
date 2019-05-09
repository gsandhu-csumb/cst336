<?php 
include("shell/topPurchase.php");
include("api/db/Database.php");
session_start();

$productDao = Database::getProductDao();
$purchasesDao = Database::getPurchasesDao();

$total = 0;
foreach($_SESSION["cart"] as $id){
    $product = $productDao->findById($id);
    $total += $product->price;
}

$purchasesDao->insert($total);

$_SESSION["cart"] = null;
unset($_SESSION["cart"]);
?>
<script>
    
</script>
<div id="video-home">
    <video id="video-bg" preload="auto" loop autoplay>
        <source type="video/webm" src="/cst336/shoeStore/assets/video/city_walking.webm">
    </video>
    <div id="overlay"></div>
    <div id="logo">
        <h1>Thank You for your Purchase!</h1>
    </div>
    <script>
        setTimeout(function(){
            window.location = "cart.php"
        }, 1000);
    </script>
</div>
<?php include("shell/bottom.php") ?>
<?php

session_start();

if(isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];   
} else {
    $cart = array();
}

?>

<?php include("shell/top.php") ?>

<link href = "https://fonts.googleapis.com/css?family=Quantico" rel="stylesheet">

<style>
    
    .row  { 
        display:flex; 
        
    }
    
    .col1 { 
        width:350px; 
        
    }
    /*.col2{*/
    /*  font-family: 'Quantico', sans-serif;*/
    /*}*/
    
    #total-cost {
        font-size: 1.7em;
    }
    
    form { 
        display: inline-block; 
        
    }
    
    #shoes-in-cart {
      width: 25%;
      margin: 0 auto;
    }
    
    img {
      padding: 20px; 
      width: 200px;
      height: 150px;  
    }
    
    .empty {
        font-size: 2.5em;
        /*font-family: 'Quantico', sans-serif;*/
    }
</style>

<script>
    /* global $*/
    var totalCost = 0.0;
    var idHolder = 0;
    // Will be called for each item in cart, to display item
    function getById(id) {
        $.ajax({
            type: "GET",
            url: "api/product/getById.php",
            dataType: "json",
            data: { "id": id },
            success: function(data,status) {
                //TODO: Append to shoes-in-cart div to Display Shoes in Cart page
                let price = parseFloat(data.price);
                totalCost += price;
                console.log(totalCost);
                idholder = data.id;
                $("#shoes-in-cart").append("<div class='row'>" + 
                                    "<div class='col1'>" + 
                                    "<input type='hidden' name='productId' value='"+ data.id + "'>" +
                                    "<a href='view.php?id="+data.id+"'> " + "<div class='col2'>"+data.name + "</a></div>"+"<img src ="  + data.thumbnail + ">"+
                                    "<div class='col2'>"+"$" + data.price + "</div>"+"<div id=imgSize>"+ "</div>"+
                                    // "<button class='btn btn-outline-danger'>Update</button></form>   "+
                                    "<form>" +"<br>" +"<button class='delete' id=" + data.id + " >Delete</button>" + "<br><br/>" + "</form>" + "<hr>"+
                                    "</div><br><br>");
            },
            complete: function(data,status) { //optional, used for debugging purposes
            }
        });//ajax
    }

    // To delete item from cart
    $(document).on("click", '.delete', function() {
            $.ajax({
            type: "GET",
            url: "api/user/deleteFromCart.php",
            dataType: "json",
            data: { "id": $(this).attr("id") },
            success: function(data,status) {
                
            },
            complete: function(data,status) { //optional, used for debugging purposes
            //alert(status);
            }
        });//ajax       
    });
    
    //  $(document).ready(function() {
    //     $("#confirmCart").on("click", function() {
    //         $("#test").hide();
    //         $.ajax({
    //         type: "GET",
    //         url: "api/user/deleteFromCart.php",
    //         dataType: "json",
    //         data: { "id": $(this).attr("idHolder") },
    //         success: function(data,status) {
    //             window.location = "confirmCart.php";
    //         },
    //         complete: function(data,status) { //optional, used for debugging purposes
    //         //alert(status);
    //         }
    //     });//ajax   
    //     }); //On updateProduct Click 
    // }); //Doc Ready
    
    
    
    // Called when ajax calls are finished, or else total cost will always stay at 0
    $(document).ajaxStop(function () {
        $("#total-cost").html("Total Cost:  $" + totalCost.toFixed(2).toString());
    });

    $(document).ready(function() {
        
        // Grab Cart from Session
        var cart = <?php echo json_encode($cart);?>;
        
        if(cart.length == 0) {
            $("#shoes-in-cart").attr("class", "empty");
            $("#shoes-in-cart").html("Cart is Empty");
            $("#confirmCart").hide();
        } else {
            $("#shoes-in-cart").html("");
            $("#goCat").hide();
            $("#confirmCart").show();
            for(let i = 0; i < cart.length; ++i) {
                getById(cart[i]);
            }
            // for (let i = cart.length() - 1; i >= 0; i--) {
            //     getById(cart[i]);
            // }
        }

    });



</script>
<h1>Otter Shoe Store - Your Cart</h1>
<hr>
<div id="shoes-in-cart"></div><br>
<hr>
<div id="total-cost"></div><br><br>
<form action="catalog.php">
    <button id="goCat">Go To Catalog</button>
</form>
<form action="confirmCart.php">
<button id="confirmCart">Confirm Purchase</button>
</form>



<?php include("shell/bottom.php") ?>
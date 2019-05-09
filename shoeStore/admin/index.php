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
        header("Location: /cst336/shoeStore/admin/login.php");
        die();
    }
} else {
    // found no valid session user id, take them back 
    header("Location: /cst336/shoeStore/admin/login.php");
    die();
}
//if we reach here, user is an admin and is logged in
$item = Database::getProductDao()->findById($_GET["id"]);

include("../shell/top.php");
?>

<div class="navigation-bar">
    <a href="/cst336/shoeStore/admin/" other="/cst336/shoeStore/admin/index.php">＋ Admin Home</a>
    <a href="/cst336/shoeStore/admin/newItem.php">＋ New Item</a>
</div>
        <link href = "https://fonts.googleapis.com/css?family=Quantico" rel="stylesheet">
<style>
        
            .row  { display:inline-block; }
        
            .col1 { width:350px; }
            .col2{
              font-family: 'Quantico', sans-serif;
            }
            
      form { display: inline-block; }
            
            #products {
              /*width: 25%;*/
              margin: 0 auto;
            }
            
            img {
              padding: 20px; 
              width: 200px;
              height: 150px;  
            }
            
            .btn {
                border: none;
                width: 100px;
                text-align: center;
                display: inline-block;
                font-size: 15px;
                box-sizing: content-box; 
                height: 25px;
                background: none;
                padding: 0;
                color: black;
                border-radius: 25px;
            }
            
            .btn:hover {
                cursor: default;
                color: white;
            }
            
            .btn-primary {
                box-shadow: 0 0 0 2px green;
                margin-right: 5px;
            }
            
            .btn-primary:hover {
                background-color: #27ae60;
            }
            
            .btn-outline-danger {
                box-shadow: 0 0 0 2px red;    
            }
            
            .btn-outline-danger:hover {
                background-color: #c0392b;
            }
            
            .buttons {
                display: flex;
                align-items:center;
                justify-content:center;
            }
            
            .refreshPage {
                visibility: hidden;
            }
            
            #reportResponse {
                display: inline-block;
            }

        </style>  
        
        <script>
            /* global $ */
            function confirmUpdate(){
                return confirm("Are you sure you want to delete this product?");
            }
             function confirmDelete(){
                return confirm("Are you sure you want to add this product?");
            }
            function openModal(){
                $('#productModal').modal("show"); //opens the modal
            }
            
            
            function getAllProducts() {
                //Gets first 10 products from the database and displays them
                $.ajax({
                    type: "GET",
                    url: "../api/product/getAllProducts.php",
                    dataType: "json",
                    success: function(data,status) {
                      //alert(data[0].productName);
                      data.forEach(function(product){
                          $("#products").append("<div class='row'>" + 
                                                "<div class='col1'>" + 
                                                //"<form action='update.php' method='post' onsubmit='return confirmUpdate()'>"+
                                                "<input type='hidden' name='productId' value='"+ product.id + "'>" +
                                                //Uncomment if we are making a modal view"<a target='productIframe' onclick='openModal()' href='productInfo.php?productId="+product.id+"'> " + "<div class='col2'>"+product.name + "</a></div>"+
                                                "<a href='../view.php?id="+product.id+"'> " + "<div class='col2'>"+product.name + "</a></div>"+
                                                "<div class='col2'>"+"$" + product.price + "</div>"+"<div id=imgSize>"+"<img src ="  + product.thumbnail + ">" + "</div>"+ "<hr>"+
                                                //"<a href='update.php?productId="+product.id+"'> Update </a>" +
                                                "<div id='buttons'><a class=\"btn btn-primary\"  href='update.php?productId="+product.id+"'> Update </a>" +
                                                "<button class=\"btn btn-outline-danger\" id='" + product.id + "' >Delete</button>" + "</div><br><br/>" +
                                                "</div><br><br>");
                      })
                    },
                    complete: function(data,status) { //optional, used for debugging purposes
                            //alert(status);
                            }
                });//ajax        
            }
            
            $(document).on("click", ".btn-outline-danger", function() {
                if(confirmDelete()) {
                    $.ajax({
                        type: "POST",
                        url: "../api/product/deleteItem.php",
                        dataType: "json",
                        data: { "id": $(this).attr("id") },
                        success: function(data,status) {
                            
                        },
                        complete: function(data,status) { //optional, used for debugging purposes
                        }
                    });//ajax   
                    setTimeout(function(){
                        $("#products").html("");
                        getAllProducts();
                    }, 500);
                }
            });
            
            function searchAdmin() {
                
                let adminSearch = $("input[name=adminFunc]:checked").val();
                if (adminSearch == "avgPrice") {
                    $.ajax({
                        url: "../api/product/getByAvg.php",
                        dataType: "json",
                        success: function(data, status){
                            $("#reportResponse").html("Average price of all products: $" + data);
                        }
                    });//ajax
                } else if (adminSearch == "numProduct") {
                    $.ajax({
                        url: "../api/product/getByAmount.php",
                        dataType: "json",
                        success: function(data, status){
                            $("#reportResponse").html("Number of Products: " + data);
                        }
                    });//ajax
                } else if (adminSearch == "maxProduct") {
                    $.ajax({
                        url: "../api/product/getByMax.php",
                        dataType: "json",
                        success: function(data, status){
                            $("#reportResponse").html("Most expensive product price: " + /*data["name"] +*/ " ($" + data["price"] + ")");
                        }
                    });//ajax
                } else if(adminSearch == "avgSale"){
                    $.ajax({
                        url: "../api/product/getAvgSale.php",
                        dataType: "json",
                        success: function(data, status){
                            $("#reportResponse").html("Average Sale Total: $" + data["price"]);
                        }
                    });//ajax
                }
            }
            
            $(document).ready(function(){
                getAllProducts();
            });//documentReady
        </script>
    </head>
    <body>
        <h1>Otter Shoe Store - Admin Section</h1>
        <span>Welcome <?= Database::getUserDao()->findById($_SESSION['id'])->username ?></span>
        <hr>
        
        <form action="newItem.php"><!--addProducts.php-->
            <button>Add New Product</button>
        </form>
        
        <form action="logout.php">
            <button>Logout</button>
        </form>
        <br>
            <input type="radio" name="adminFunc" value="avgPrice"><label for="avgPrice">Avg Price of Products (Avg) </label><br>
            <input type="radio" name="adminFunc" value="numProduct"><label for="numProduct">Num of Products (Count) </label><br>
            <input type="radio" name="adminFunc" value="maxProduct"><label for="maxProduct">Most Expensive (Max) </label><br>
            <input type="radio" name="adminFunc" value="avgSale"><label for="avgSale">Avg Total per Sale </label><br>
            <button onclick='searchAdmin()' id="submitBtn">Submit</button>
        <br><br>
        <div id="reportResponse"></div>
        <br>
        <hr>
        <div id="products"></div>
    </body>
</html>
<?php include("../shell/bottom.php"); ?>
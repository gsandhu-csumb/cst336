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
    <link href = "https://fonts.googleapis.com/css?family=Quantico" rel="stylesheet">
<!DOCTYPE html>
<html>
    <head>
        <style>
            .row  { display:flex; }
            .col1 { width:350px; }
            col2{
              font-family: 'Quantico', sans-serif;
            }
            form { display: inline-block; }
             #products {
              width: 25%;
              margin: 0 auto;
            }
            img {
              padding: 20px; 
              width: 200px;
              height: 150px;  
            }
        </style>   
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script>
            // function confirmUpdate(){
            //     return confirm("Are you sure you want to delete this product?");
            // }
            // function confirmDelete(){
                
            //     return confirm("Are you sure you want to delete this product?");
                
            // }
            // function openModal(){
            //     $('#productModal').modal("show"); //opens the modal
            // }
    //     $(document).ready(function(){
    //     //Gets first 10 products from the database and displays them
    //     $.ajax({
    //         type: "GET",
    //         url: "../api/product/getAllProducts.php",
    //         dataType: "json",
    //         success: function(data,status) {
    //           //alert(data[0].productName);
    //           data.forEach(function(product){
    //               $("#products").append("<div class='row'>" + 
    //                                     "<div class='col1'>" + 
    //                                     //"<a class=\"btn btn-primary\"  href='update.php?productId="+product.id+"'> Update </a>" +
    //                                     //"[<a href='delete.php?productId="+product.productId+"'> Delete </a>]" +
    //                                     //"<form action='update.php' method='post' onsubmit='return confirmUpdate()'>"+
    //                                     //"<form action='delete.php' method='post' onsubmit='return confirmDelete()'>"+
    //                                     "<input type='hidden' name='productId' value='"+ product.id + "'>" +
    //                                     //Uncomment if we are making a modal view"<a target='productIframe' onclick='openModal()' href='productInfo.php?productId="+product.id+"'> " + "<div class='col2'>"+product.name + "</a></div>"+
    //                                     "<a href='../view.php?id="+product.id+"'> " + "<div class='col2'>"+product.name + "</a></div>"+
    //                                     "<div class='col2'>"+"$" + product.price + "</div>"+"<div id=imgSize>"+"<img src ="  + product.thumbnail + ">" + "</div>"+ "<hr>"+
    //                                     // "<a href='update.php?productId="+product.id+"'> Update </a>" +
    //                                     "<a class=\"btn btn-primary\"  href='update.php?productId="+product.id+"'> Update </a>" +
    //                                     "<button class=\"btn btn-outline-danger\">Delete</button></form>" + "<br><br/>" +
    //                                     "</div><br><br>");
    //           })
    //         },//"<img src =" + product.thumbnail + ">"
    //         complete: function(data,status) { //optional, used for debugging purposes
    //                 //alert(status);
    //                 }
    //     });//ajax
    // });//documentReady
    $(document).ready(function(){
        $("#submitBtn").on( "click", function() { 
        $("#catalog-listing").html("");
        let shoeSearch = $("input[name=orderBy]:checked").val();
        // keyVal = $("#shoeName").val();
        if (shoeSearch == "avgPrice") {
            $.ajax({
                url: "api/product/getByAvg.php",
                dataType: "json",
                success: function(data, status){
                
        }});//ajax
        }
        if (shoeSearch == "numProduct") {
            $.ajax({
                url: "api/product/getByAmount.php",
                dataType: "json",
            success: function(data, status){
            $("#product").html(data.id);
        }});//ajax
        }
        
        if (shoeSearch == "maxProduct") {
            $.ajax({
                url: "api/product/getByMax.php",
                dataType: "json",
            success: function(data, status){
                    let row = $("<tr>");
            data.forEach(function(entry){
                // insert item into our catalog listing
                row.append(ITEM_TEMPLATE
                            .replace("{id}", entry["id"])
                            .replace("{thumbnail}", entry["thumbnail"])
                            .replace("{name}", entry["name"])
                            .replace("{price}", entry["price"])
                );
                // have 3 shoes per row
                if(row.children().length == 3){
                    $("#catalog-listing").append(row);
                    row = $("<tr>");
                }
            });
            // append the last row if it's not empty
            if(row.children().length != 3){
                $("#catalog-listing").append(row);
            }
        }});//ajax
        }
                    
                    
                });
   
   
   
    });
    
    
        </script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </head>
    <body>
        <h1>Otter Shoe Store - Admin Section</h1>
        <span>Welcome <?= Database::getUserDao()->findById($_SESSION['id'])->username ?></span>
        <hr>
        <input type="radio" name="adminFunc" value="avgPrice"><label for="avgPrice">Avg Price of Products (Avg) </label><br>
        <input type="radio" name="adminFunc" value="numProduct"><label for="numProduct">Num of Products (Count) </label><br>
        <input type="radio" name="adminFunc" value="maxProduct"><label for="maxProduct">Most Expensive (Max) </label><br>
        <button id="submitBtn">Submit</button>
        <br><br>
        <div id="products"></div>
        <table id="catalog-listing"></table>
          <!-- Button trigger modal -->
        <!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">-->
        <!--  Launch demo modal-->
        <!--</button>-->
        <!-- Modal -->
        <!--<div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">-->
        <!--  <div class="modal-dialog" role="document">-->
        <!--    <div class="modal-content">-->
        <!--      <div class="modal-header">-->
        <!--        <h5 class="modal-title" id="exampleModalLongTitle">Product Info</h5>-->
        <!--        <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
        <!--          <span aria-hidden="true">&times;</span>-->
        <!--        </button>-->
        <!--      </div>-->
        <!--      <div class="modal-body">-->
        <!--        <iframe name="productIframe"  width="400" height="400"></iframe>-->
        <!--      </div>-->
        <!--      <div class="modal-footer">-->
        <!--        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
        <!--      </div>-->
        <!--    </div>-->
        <!--  </div>-->
        <!--</div>-->
    </body>
</html>
<?php include("../shell/bottom.php"); ?>
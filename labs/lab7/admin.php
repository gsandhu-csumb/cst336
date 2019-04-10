<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Ottermart - Admin Section </title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        
        <script>
            
            $(document).ready(function(){
                
                //Gets first 10 products from the database and displays them
                $.ajax({

                    type: "GET",
                    url: "../lab6/api/getProducts.php",
                    dataType: "json",
                    success: function(data,status) {
                      //alert(data[0].productName);
                      data.forEach(function(product){
                          $("#products").append("<div class='row'>" + 
                                                "<div class='col1'>" + 
                                                "[<a href='update.php?productId="+product.productId+"'> Update </a>]" +
                                                "[<a href='delete.php'> Delete </a>]" +
                                                product.productName + "</div>"+
                                                "<div class='col2'>"+"$" + product.productPrice + "</div>"+
                                                "</div>");
                      })
                    },
                    complete: function(data,status) { //optional, used for debugging purposes
                    //alert(status);
                    }
                    
                });//ajax
                
               
                
            });//documentReady
            
        </script>

        <style>
        
            .row  { display:flex; }
        
            .col1 { width:250px; }

        </style>                
    </head>
    <body>

        <h1> Ottermart - Admin Section </h1>

        Welcome <?=$_SESSION['adminName']?>
        
    <br><hr><br>
    
    <form action="addProducts.php">
        <button>Add New Product</button>
    </form>
    
     <div id="products"></div>

    </body>
</html>
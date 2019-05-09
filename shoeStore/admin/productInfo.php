<!DOCTYPE html>
<html>
    <head>
        <title> Product Information </title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script>
        $(document).ready( function(){    
              $.ajax({
                    type: "GET",
                    url: "../api/product/getFeatured.php",
                    dataType: "json",
                    data:{"productId": <?=$_GET['productId']?>},
                    success: function(data, status) {
                         $("#productName").html(data["name"]);
                         $("#productDescription").html(data["description"]);
                         $("#productPrice").html("$"+data["price"]);
                         $("#productImage").attr("src", data["thumbnail"]);
                    }
                });
        });
        </script>
    </head>
    <body>
        <h2 id="productName"></h2>
        <h3 id="productDescription"></h3>
        <img src="" id="productImage" width="200"/>
        <div id="productPrice"></div>
    </body>
</html>
<?php include("shell/top.php") ?>
<link rel="stylesheet" href="css/styles.css">
<h1>Browse Our Selection</h1>
<script>
// template string for an item on our catalog
var ITEM_TEMPLATE = `            
<td><a href="view.php?id={id}"><div class="item">
    <img src="{thumbnail}"/>
    <span>{name}</span>
    <br/>
    <span>\${price}</span>
</div></a>
</td>
`
/* global $ */
let keyVal = "";
$(function(){
    $.ajax({
        url: "api/product/getAllProducts.php",
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
        }
    });//ajax
    
    
});//function

function searchShoes() {
        $("#catalog-listing").html("");
        let shoeSearch = $("input[name=orderBy]:checked").val();
        // keyVal = $("#shoeName").val();
        
        if (shoeSearch == "priceAsc") {
            $.ajax({
                url: "api/product/getByAsc.php",
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
        
        if (shoeSearch == "priceDesc") {
            $.ajax({
                url: "api/product/getByDesc.php",
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
        
        if (shoeSearch == "alphabAsc") {
            $.ajax({
                url: "api/product/getByAbc.php",
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
     if (shoeSearch == "colorAsc") {
            $.ajax({
                url: "api/product/getByColor.php",
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
    
}//searchShoes()
</script>


<div id="query-selection">
    <div id="query-top-padding">Order By</div><br>
    <!--<input type="text" id="shoeName" placeholder="Shoe Name"/><br><br>-->
    
    <!--Order By<br>-->
    <input type="radio" name="orderBy" value="colorAsc"><label for="colorAsc">Color (ASC) </label><br>
    <input type="radio" name="orderBy" value="priceAsc"><label for="priceAsc">Price (ASC) </label><br>
    <input type="radio" name="orderBy" value="priceDesc"><label for="priceDesc">Price (DESC) </label><br>
    <input type="radio" name="orderBy" value="alphabAsc"><label for="alphabAsc">Alphabetically (ASC) </label><br><br>
    
    <div id="query-bottom-padding"><button onclick='searchShoes()' id="query-submit-button">Submit</button></div>
    
</div>


<table id="catalog-listing"></table>
<?php include("shell/bottom.php") ?>
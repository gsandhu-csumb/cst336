<?php

 if (!empty($_FILES)) {
    if($_FILES['myFile']['size'] > 1024000){
        echo "File is too big";
    }else{
        move_uploaded_file( $_FILES['myFile']['tmp_name'], "gallery/" . $_FILES['myFile']['name']);
        $_CHECK = 1;
    }
}
    function displayImagesUploaded() {
        $images = scandir("gallery"); //returns all file names within a folder
        //print_r($images);
        for ($i = 2; $i < count($images); $i++) {
            //echo "<img src='gallery/$images[$i]' width='50' />";
            echo "<a href = 'gallery/$images[$i]' width='500' ><img src = 'gallery/$images[$i]' width='100'></a>";
        }//for
    }//function


?>


<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link href = "https://fonts.googleapis.com/css?family=Quantico" rel="stylesheet">
        <title> Lab 9: File Upload </title>
        <style>
            img { padding: 10px; }
            img:hover { width: 250px; }
            body{
                text-align: center;
                background: pink;
                font-family: 'Quantico', sans-serif;
            }
            h3{
                color:white;
            }
        </style>
        
    </head>
    <body>
        
        <h1>Upload Your Images!</h1>
        <br><br>
        <form  method="POST" enctype="multipart/form-data">
            <input type="file" name="myFile" />
            <button> Upload File! </button>
        </form>
          <br><br>
        <hr>
        <h3> Images uploaded: </h3>
        <?= displayImagesUploaded() ?>
    </body>
</html>
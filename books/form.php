<?php
    session_start();
    if ($_SESSION["admin-login"] == false) {
        header("Location: library/admin/login.php");
        exit();
    }
    include('connect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Registration</title>
</head>
    <style>
       body{
            background-color: rgb(160, 239, 255);
            font-family: Arial, sans-serif;
            color: rgb(255, 255, 255);
            text-align: center;
        }
        .container{
            width: 250px;
            height: 420px;
            margin: 100px auto;
            padding: 5px;
            background-color: rgb(5, 5, 5);
            border-radius: 5px;
            box-shadow: 0 0 10px rgb(0, 135, 254);
        }
        .buttons{
            background-color: rgb(0, 135, 254);
            color: white;
            border: none;
            padding: 5px 5px;
            cursor: pointer;
            border-radius: 5px;
        }
        .upload{
            background-color:black;
            color: white;
            border: 6px double white;
            padding: 3px 25px;
            cursor: pointer;
            border-radius: 5px;
        }
        .file-input{
            width: 80%;
            padding: 5px;
            margin: 2px;
            border: 2px solid rgb(0, 174, 189);
            border-radius: 5px;
            border: 2px solid white;
        }
        .user-input{
            width: 80%;
            padding: 5px;
            margin: 2px;
            border: 2px solid rgb(0, 174, 189);
            border-radius: 5px;
            border: 4px double black;
        }
        .input-field{
            margin-left: 5px;
        } 
    </style>
<body>
<div>
    <div class="container">  
        <form action = "connect.php" method = "POST" enctype="multipart/form-data">
            <h2 style = "text-align: center;">Oronya's Library</h2>
            <h3 style = "text-align: center;">Management System</h3>
            <hr>
            <h3  style = "text-align: center;">Book Register</h3>
            <hr>

            <div class = "input-field" style="font-size: 14px; font-family: arial narrow;">
                Upload book (pdf) <br>
                <input type="file" name="title" class="file-input" accept="pdf/*">
            </div>
            <br>

            <div class = "input-field" style="font-size: 14px; font-family: arial narrow;">
                Upload book cover (jpg, jpeg, png, bmp) <br>
                <input type="file" name="cover" class="file-input" accept="image/*">
            </div>
            <br>

            <div class = "input-field">
                <input type = "text" name = "book_id" class="user-input" placeholder = "Genre">
            </div>
            <br>

            <input type = "submit" class="buttons" name = "submit" value = "Register">
            &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
            <input type = "submit" class="buttons" name = "cancel" value = "Cancel">
        </form>
    </div>
</div>

</body>
</html>
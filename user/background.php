<?php
    session_start();
    if ($_SESSION["user-login"] == false) {
        header("Location: http://localhost/library/admin/login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Admin Background Image</title>
</head>
    <style>
        body{
        background-color: rgb(160, 239, 255);
        font-family: Arial, sans-serif;
        color: rgb(255, 255, 255);
        }
        .container{
            width: 300px;
            height: 100px;
            margin: 100px auto;
            padding: 20px;
            background-color: rgb(0, 19, 144);
            border-radius: 5px;
            box-shadow: 0 0 10px rgb(0, 135, 254);
        }
        .buttons{
            background-color: rgb(0, 135, 254);
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }
        .user-input{
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 2px solid rgb(0, 174, 189);
            border-radius: 5px;
        }
    </style>
<body>
    <div class = "container">
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="file" name="background" class = "user-input">
            <input type="submit" name="submit" value="Update" class = "buttons">
        </form>
    </div>
    
</body>
</html>
<?php
    if(isset($_POST["submit"])){
        $conn = new mysqli("localhost", "root", "Ruth@0002", "businessdb");
        $username = $_SESSION['username'];

        $image_name = $_FILES['background']['name'];
        $temp_name  = $_FILES['background']['tmp_name'];
        $file_size = $_FILES['background']['size'];
        $file_error = $_FILES['background']['error'];
        $file_type = $_FILES['background']['type'];

        // Create unique filename
        $upload_folder = "background/" . $image_name;
        move_uploaded_file($temp_name, $upload_folder);

        $sql = "UPDATE user SET background = '$image_name' WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);

        if($result){
            echo"<script>
            window.location.href='user_page.php'; alert('Background Image Updated Successfully');
            </script>";
        }
    }
?>
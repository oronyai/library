<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
</head>

<style>
    body{
    background-color: rgb(160, 239, 255);
    font-family: Arial, sans-serif;
    color: rgb(255, 255, 255);
    }
    .container{
        width: 310px;
        height: 550px;
        margin: 100px auto;
        padding: 10px;
        background-color: rgb(0, 19, 144);
        border-radius: 5px;
        box-shadow: 0 0 10px rgb(0, 135, 254);
    }
    .login-link{
        color: rgb(32, 253, 253);
        text-decoration: none;
    }
    .login-link:hover{
        color: rgb(157, 187, 252);
        text-decoration: underline;
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
        width: 41%;
        padding: 5px;
        margin: 2px;
        border: 2px solid rgb(0, 174, 189);
        border-radius: 5px;
    }
    #email{
        width: 90%;
        padding: 5px;
        margin: 2px;
        border: 2px solid rgb(0, 174, 189);
        border-radius: 5px;
    }
    .user-input-last-child{
        width: 90%;
        padding: 5px;
        margin: 2px;
        border: 2px solid rgb(0, 174, 189);
        border-radius: 5px;
    }
    
</style>

<body>
    <div class = "container">
            <h1 style = "text-align: center;">Oronya's Library</h1>
            <h2 style = "text-align: center;">Management System</h2>
            <hr>
            <h3  style = "text-align: center;">User Registration</h3>
            <hr>

        <form class = "form" style = "text-align: center;" action = "registration.php" method = "POST" enctype="multipart/form-data">

            <input type="text" id="username" class="user-input" name="username" placeholder="Username" required>

            <input type="text" id="password" class="user-input" name="password" placeholder="Password" required><br><br>

            <input type="email" id="email" class="user-input" name="email" placeholder="Email" required><br><br>

            <input type="text" id="contact" class="user-input" name="contact" placeholder="Contact" required>

            <input type="text" id="sem" class="user-input" name="sem" placeholder="YEAR/SEM" required><br><br>

            <input type="text" id="enrol" class="user-input-last-child" name="enrol" placeholder="Enrollment No." required><br><br>
            
            <div style="font-size: 13px; text-align: left; margin-left: 16px; margin-bottom: -10px;">Upload Profile Picture (jpg, jpeg, png):</div><br>
            <input type="file" accept="image/*" class="user-input-last-child" name="profile" required><br>

            <input type = "submit" class="buttons" name = "submit" value = "Register">

            <p>Already have an account? <a href= "library/index.php" class="login-link"> Login</a></p>
        </form>
    </div>
    
</body>
</html>

<?php
    require_once 'library/config.php';
    if($_SERVER["REQUEST_METHOD"] == "POST"){

    //Other details
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $contact = filter_input(INPUT_POST, "contact", FILTER_SANITIZE_NUMBER_INT);
        $sem = $_POST['sem'];
        $enrol = $_POST['enrol'];
        
        // Image upload
        $image_name = $_FILES['profile']['name'];
        $temp_name  = $_FILES['profile']['tmp_name'];
        $file_size = $_FILES['profile']['size'];
        $file_error = $_FILES['profile']['error'];
        $file_type = $_FILES['profile']['type'];

        // Create unique filename
        $new_name = time() . "_" . $image_name;
        $upload_folder = "profile/" . $new_name;
        move_uploaded_file($temp_name, $upload_folder);
        
        $enrolsql = "SELECT * FROM user WHERE enrol='$enrol'";
        if(mysqli_num_rows(mysqli_query($conn, $enrolsql)) > 0){
            echo "<script>
                window.location.href = 'registration.php'; alert('Error! Enrollment Number already registered')
            </script>";
        }
        else{
            $sql = "INSERT INTO user(username, email, password, contact, sem, enrol, profile)
                VALUES('$username', '$email', '$password_hash', '$contact', '$sem', '$enrol', '$new_name')";
            $result = mysqli_query($conn, $sql);

            echo "<script>
                window.location.href = 'library/index.php'; alert('Done! Admin will approve shortly.')
            </script>";
        }
    }
?>
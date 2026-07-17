<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Admin Login</title>
</head>
<body>
    <div class = "container">
        <h1 style = "text-align: center;">Oronya's Library</h1>
        <h2 style = "text-align: center;">Management System</h2>
        <hr>
        <h2  style = "text-align: center;">LIBRARIAN PORTAL</h2>
        <hr>
        <form class = "form" style ="text-align: center;" action ="login.php" method ="POST">

            <input type="submit" class="user-type" name="switch-to-user" id="switch-to-user" value="SWITCH TO USER LOGIN"><br>

            <input type="email" class="user-input" id = "email" name = "email" placeholder="Email"><br><br>
            <input type="password" class="user-input" id = "password" name = "password" placeholder="Password"><br><br>

            <input type="submit" class="buttons" name="login" value="Login">
            &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
            <a href= "passwordReset.php" class="login-link">Forgot password?</a><br>

            <p>Don't have an account? <a href="registration.php" class="login-link"> Register</a></p>

        </form>
    </div>
</body>
</html>

<?php

    session_start();
    require_once 'library/config.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        if(password_verify($password, $password_hash)){
            echo"<script>
                window.location.href='login.php';
                alert('Invalid Password!');
            </script>";
        }

        $sql = "SELECT * FROM admin WHERE email='$email'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $_SESSION["email"] = $email;
            $_SESSION["password"] = $password_hash;
            $_SESSION["admin-login"] = true;
            header("Location: admin_page.php");
            exit();

        } else {
            echo "<script>
                window.location.href = 'login.php'; alert('Error! Please check your credentials')
            </script>";
        }
    }

    if(isset($_POST['switch-to-user'])){
        header("Location: library/index.php");
    }
?>
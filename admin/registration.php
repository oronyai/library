<?php
    include ("connect.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class = "container">
            <h2 style = "text-align: center;">Library Management System</h2>
            <h3  style = "text-align: center;">Admin Registration Form</h3>

        <form class = "form" style = "text-align: center;" action = "connect.php" method = "POST">
            <input type="text" id = "firstName" name = "firstName" placeholder="First Name" class="user-input" required><br>

            <input type="text" id = "lastName" name = "lastName" placeholder="Last Name" class="user-input" required><br>

            <input type="email" id = "email" name = "email" placeholder="Email" class="user-input" required><br>

            <input type="text" id = "password" name = "password" placeholder="Password" class="user-input" required><br>

            <input type="text" id = "contact" name = "contact" placeholder="Contact" class="user-input" required><br>

            <input type="submit" name="submit" class="buttons" value="Register">

            <p>Already have an account? <a href= "login.php" class="login-link"> Login</a></p>
        </form>

    </div>
    
</body>
</html>
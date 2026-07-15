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
            <h3  style = "text-align: center;">RESET ADMIN PASSWORD</h3>

        <form class = "form" style = "text-align: center;" action = "passwordReset.php" method = "POST">
            <input type="text" id = "firstName" name = "firstName" placeholder="Enter Registered First Name" class="user-input" required><br>

            <input type="email" id = "email" name = "email" placeholder="Enter Registered Email" class="user-input" required><br>

            <input type="text" id = "contact" name = "contact" placeholder="Enter Registered Contact" class="user-input" required><br>

            <input type="password" id = "new_password" name = "new_password" placeholder="Enter New Password" class="user-input" required><br>

            <input type="password" id = "confirm" name = "confirm" placeholder="Confirm New Password" class="user-input" required><br>

            <input type="submit" name="reset_password" class="buttons" value="RESET PASSWORD">

            <p>Don't have an account? <a href= "registration.php" class="login-link"> Register </a></p>
        </form>

    </div>
    
</body>
</html>

<?php
    $conn = mysqli_connect("localhost", "root", "Ruth@0002", "businessdb");

    if(isset($_POST['reset_password'])){
        $firstName = $_POST['firstName'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $new_password = $_POST['new_password'];
        $confirm = $_POST['confirm'];

        if($new_password == $confirm){
            $sql = "SELECT * FROM admin WHERE firstName = '$firstName' AND email = '$email' AND contact = '$contact'";
            $result = mysqli_query($conn, $sql);
            

            if(mysqli_num_rows($result) == 1){
                $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                $sql1 = "UPDATE admin
                    SET password = '$password_hash'
                    WHERE email = '$email'";
                $result1 = mysqli_query($conn, $sql1);
            
                if($result){
                    echo "<script>
                        window.location.href='login.php'; 
                        alert ('Success! Password has been reset')
                    </script>";
                }

            } else {
                echo "<script>
                    window.location.href='passwordReset.php'; 
                    alert ('Error in credentials entered')
                </script>";
            }

        }else {
            echo "<script>
                window.location.href='http://localhost/library/admin/passwordReset.php'; 
                alert ('Error! Passwords not matching')
            </script>";
        }
    }

?>
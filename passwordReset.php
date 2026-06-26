
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
            <h2 style = "text-align: center;">Oronya's Library</h2>
            <hr>
            <h3  style = "text-align: center;">RESET USER PASSWORD</h3>
            <hr>

        <form class = "form" style = "text-align: center;" action = "passwordReset.php" method = "POST">

            <input type="text" name = "username" placeholder="Enter Registered Username" class="user-input" required><br>

            <input type="text" name = "email" placeholder="Enter Registered Email" class="user-input" required><br>

            <input type="text" name = "enrol" placeholder="Enter Enrollment Number" class="user-input" required><br>

            <input type="password" name = "new_password" placeholder="Enter New Password" class="user-input" required><br>

            <input type="password" name = "confirm" placeholder="Confirm Password" class="user-input" required><br>

            <input type="submit" name="reset_password" class="buttons" value="RESET">

            <p>Don't have an account? <a href= "user/registration.php"  class="login-link"> Register</a></p>
        </form>

    </div>
    
</body>
</html>

<?php
    $conn = mysqli_connect("localhost", "root", "", "businessdb");

    if(isset($_POST['reset_password'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $enrol = $_POST['enrol'];
        $new_password = $_POST['new_password'];
        $confirm = $_POST['confirm'];

        if($new_password == $confirm){
            $sql = "SELECT * FROM user WHERE username = '$username' AND email = '$email' AND enrol = '$enrol'";
            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result) == 1){
                $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                $sql1 = "UPDATE user
                    SET password = '$password_hash'
                    WHERE username = '$username'";
                $result1 = mysqli_query($conn, $sql1);
            
                if($result){
                    echo "<script>
                        window.location.href='http://localhost/library/index.php'; 
                        alert ('Success! Password has been reset')
                    </script>";
                }

            } else {
                echo "<script>
                    window.location.href='http://localhost/library/passwordReset.php'; 
                    alert ('Error in credentials entered')
                </script>";
            }

        }else {
            echo "<script>
                window.location.href='http://localhost/library/passwordReset.php'; 
                alert ('Error! Passwords not matching')
            </script>";
        }
    }

?>
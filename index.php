<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="user/style.css">
</head>
<body>
    <div class = "container" style = "background-color: rgb(2, 0, 97);">
        <h1 style = "text-align: center;">Oronya's Library</h1>
        <h2 style = "text-align: center;">Management System</h2>
        <hr>
        <h2  style = "text-align: center;">CLIENT PORTAL</h2>
        <hr><br>
        <form class="form" style="text-align: center;" action="index.php" method="POST">

            <input type="text" class="user-input" id = "username" name = "username" placeholder="Username"><br><br>
            <input type="password" class="user-input" id = "password" name = "password" placeholder="Password"><br><br>

            <input type = "submit" class="buttons" name = "login" value = "Login">
            &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
            <a href= "passwordReset.php" class="login-link">Forgot password?</a><br><br>

            <hr>
            <p>Don't have an account? <a href= "user/registration.php"  class="login-link"> Register</a></p>
            <hr>
        </form>
    </div>
</body>
</html>

<?php
    session_start();
    $conn = mysqli_connect('localhost', 'root', '', 'businessdb');

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $id = $_POST['id'];
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = $_POST['password'];

        $sql = "SELECT * FROM user WHERE username='$username'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $status = $row['status'];
        $username = $row["username"];
        $password_hash = $row['password'];
        $profile = $_POST['profile'];

        if(!password_verify($password, $password_hash)){
            echo "<script>
                window.location.href='index.php';
                alert('Invalid Password!');
            </script>";
        } else 
        {
            $statussql = "SELECT * FROM user WHERE username='$username' AND status='approved'";
            $statusresult = mysqli_query($conn, $statussql);

            $check_user = mysqli_num_rows($statusresult);
            
            if($check_user == 1){
                $_SESSION['id'] = $id;
                $_SESSION["username"] = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
                $_SESSION["password"] = $password_hash;
                $_SESSION['profile'] = $profile;
                $_SESSION["user-login"] = true;
                header("Location: user/user_page.php");
            }
            else if($status == 'pending'){
                echo "<script>
                window.location.href = 'index.php'; alert('Your Account is PENDING ADMIN APPROVAL')
                </script>";
            }
            else {
                echo "<script>
                    window.location.href = 'index.php'; alert('Error! Please check your credentials')
                </script>";
            }
        }
    }
?>
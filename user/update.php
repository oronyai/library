<?php
    session_start();
    if ($_SESSION["user-login"] == false) {
        header("Location: index.php");
        exit();
    }
?>

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
    .delete{
        background-color: rgb(254, 55, 0);
        color: white;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        border-radius: 5px;
    }
    .delete:hover{
        animation: myAnim;
        animation-iteration-count: infinite;
        animation-duration: 2s;
    }
        @keyframes myAnim {
        0%, 100% { background:rgb(255, 60, 60); }
        25% { background: rgb(142, 7, 7); }
        55% { background: rgb(106, 0, 0); }
        75% { background: rgb(174, 29, 0); }
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
        <h3  style = "text-align: center;">User Profile Update</h3>
        <hr>
    <?php
        require_once 'library/config.php';
        $username = $_SESSION["username"];
        $sql = "SELECT * FROM user WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);

        $row = mysqli_fetch_assoc($result);
    ?>

        <form class = "form" style = "text-align: center;" action = "update.php" method = "POST" enctype="multipart/form-data">

            <input type="text" id="username" class="user-input" name="username" value=<?php echo $row["username"] ?>>

            <input type="text" id="password" class="user-input" name="password" placeholder="password"><br><br><br>

            <input type="text" id="email" class="user-input" name="email" value=<?php echo $row["email"] ?>><br><br><br>

            <input type="text" id="contact" class="user-input" name="contact" value=<?php echo $row["contact"] ?>>

            <input type="text" id="sem" class="user-input" name="sem" value=<?php echo $row["sem"] ?>><br><br><br>
            
            <div style="font-size: 13px; text-align: left; margin-left: 16px; margin-bottom: -10px;">Upload Profile Picture (jpg, jpeg, png):</div><br>
            <input type="file" accept="image/*" class="user-input-last-child" name="profile"><br><br><br>

            <input type="submit" class="buttons" name="submit" value="Update">
            &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
            <input type="submit" class="delete" name="delete" value="Delete Account">

        </form>
    </div>
    
</body>
</html>

<?php
    if(isset($_POST["submit"])){
        require_once 'library/config.php';

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

        $sql1 = "SELECT * FROM user WHERE username = '$username'";
        $result1 = mysqli_query($conn, $sql1);
        $row = mysqli_fetch_assoc($result1);
        $id = $row['id'];
        
        $sql = "UPDATE user
                SET username = '$username', email = '$email', password = '$password_hash', contact = '$contact', sem = '$sem', enrol = '$enrol', profile = '$new_name'
                WHERE id = $id";
        $result = mysqli_query($conn, $sql);

        if($result){
            echo"<script>
                window.location.href='user_page.php';alert('Your profile has been updated successfully!');
            </script>";
        } else {
            echo"<script>
                window.location.href='user_page.php';alert('Error! Profile has not been updated!');
            </script>";
        }
    }
    if(isset($_POST["delete"])){
        $username = $_SESSION['username'];

        $sql = "DELETE FROM user WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);

        echo"<script>
            window.location.href='registration.php';
            alert ('Unfortunately you have deleted your account!');
        </script>";
    }
?>
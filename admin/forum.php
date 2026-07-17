<?php
    session_start();
    if ($_SESSION["admin-login"] == false) {
        header("Location: library/admin/login.php");
        exit();
    }
    require_once 'library/config.php';
    $email = $_SESSION['email'];
    
    error_reporting(0);
    ini_set('display_errors', 0);

    $error_message = "";

    function customError($errno, $errstr, $errfile, $errline)
    {
        global $error_message;
        $error_message = "";
    }

    set_error_handler("customError");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make Post</title>
    <link rel = "stylesheet" href = "style.css">
</head>

    <style>
        .makePost{
            width: fit-content;
            height: fit-content;
            border: 4px double darkblue;
            padding: 10px;
            border-radius: 5px;
            background-color: black;
        }
        .container{
            height: fit-content;
        }
    </style>

<body>
    <div class="container">
        <div id="makePost">
            <form action="forum.php" method="POST">
                
                <textarea name="comment" class="user-input" required
                    style = "
                            height: 200px;
                            text-align: left;
                            overflow-wrap: break-word;">
                </textarea>

                <br><br>
                <input type="submit" name="add" class="buttons" value="Post">
            </form>
        </div> 
    </div> 

</body>
</html>

<?php

    if(isset($_POST['add'])){
        $comment = filter_input(INPUT_POST, "comment", FILTER_SANITIZE_SPECIAL_CHARS);

        $sql = "INSERT INTO forum (username, role, comment)
                SELECT lastName, 'ADMIN', '$comment'
                FROM admin WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);

        if($result){
            echo"<script>
                window.location.href='admin_page.php';
                alert('Your comment has been posted successfully on the forum');
            </script>";
        }
    }

?>
</body>
</html>
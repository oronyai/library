<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notice</title>
    <link rel = "stylesheet" href = "style.css">
</head>

<body>
        <div class = "container">
            <h2 style = "text-align: center;">Library Management System</h2>
            <hr>

            <h3  style = "text-align: center;">NOTICE INPUT</h3>
            <hr>

        <form action="notice.php" method="POST" style="padding: 25px;">
            
            <textarea name="notice" class="user-input" required
                style = "
                        height: 200px;
                        text-align: left;
                        overflow-wrap: break-word;">
            </textarea>

            <br><br>
            <input type="submit" name="add" class="buttons" value="Add Notice">
        </div>
    </form>  
</body>
</html>

<?php

    if(isset($_POST['add'])){
        $notice = filter_input(INPUT_POST, "notice", FILTER_SANITIZE_SPECIAL_CHARS);
        $conn = new mysqli("localhost", "root", "", "businessdb");

        $sql = "INSERT INTO noticeboard (notice)
                VALUE ('$notice')";
        $result = mysqli_query($conn, $sql);

        echo"<script>
            window.location.href='admin_page.php';
            alert('Notice successfully placed on the notice board');
        </script>";
    }

?>
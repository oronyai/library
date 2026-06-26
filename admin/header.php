
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>

    .navbar ul li a{
        display: inline-flex;
        text-align: center;
        padding: 10px;
        color: white;
    }
    .navbar ul li{
        display: block;
        height: 50px;
        background-color: rgb(0, 14, 74);
        float: left;
        border-left: 1px white solid;
        border-right: 1px white solid;
        width:140px;
    }
    .navbar ul li:hover{
        background-color: rgb(40, 120, 248);
    }
    .navbar ul li a:hover{
        color: black;
    }
    .navbar ul{
        list-style-type: none;
        background-color: rgb(0, 0, 0);
        margin-top: 30px;
        height: 50px;
        overflow: hidden;
    }
    header{
        text-align: center;
        background-color:rgb(0, 145, 255);
        height: 120px;
        max-width: 1000px;
        margin-left: auto;
        margin-right: auto;
        margin-top: -10px;
    }
    .sticky{
        position:sticky;
        top: 0;
        z-index: 9999;
    }
    .links{
        color: black;
        text-decoration: none;
        font-weight: bold;
    }
    .headings{
        font-weight: bold;
        line-height: 1.5;
    }
    .admin-intro{
        display:fixed;
        font-size: 15px;
        font-family: arial narrow;
        text-align: right;
        justify-content: right;
        padding-right: 5px;
        padding-left: 5px;
        margin-top: -55px;
        margin-left: 750px;
        color: white;
        width:fit-content;
        overflow: hidden;
        border: 2px solid white;
        border-radius: 5px;
        background-color: black;
    }
    .update-container{
        margin-left: -495px;
        margin-top: 5px;
    }
    .update-button{
        width: 103px;
        background-color: rgb(0, 145, 255);
        border-radius: 5px;
        font-size: 13px;
        font-family: arial narrow;
        padding-top: 5px;
        padding-bottom: 5px;
        padding-left: 0px;
        padding-right: 0px;
        animation: myAnim1;
        animation-iteration-count: 10;
        animation-duration: 2s;
    }
        @keyframes myAnim1 {
        0%, 100% { background:rgb(0, 200, 255); }
        33% { background: black; }
        66% { background: darkblue; }
    }
    .update-button:hover{
        background-color: rgb(0, 14, 74);;
    }
    .update-button a{
        text-decoration: none;
        color: white;
    }
    #notice{ 
        display: none;
        position: absolute;
        z-index: 9999;
        width: 400px;
        padding-right: 10px; 
        padding-top: 2px; 
        padding-bottom: 2px; 
        margin-top: 0px;
        margin-left: 362px; 
        background-color:rgb(0, 0, 0);
        border: 4px double white;
        border-radius: 5px;
        text-align: justify;
        color: white;
        animation: myAnim2;
        animation-duration: 2s;
    }
    @keyframes myAnim2 {
        from{ opacity: 0%;}
        to {opacity: 100%;}
    }
</style>

<body>

<header class = "sticky">
    <div class = "headings">
        <span style="font-family: cambria; font-size:40px">
            Oronya's Library
        </span>
        <br>
        <span style="font-family:ans-serif; font-size: 20px">
            "Book the Book, Book the Future"
        </span>
</div>

    <nav class = "navbar">
        <ul>
            <li><a href="http://localhost/library/admin/admin_page.php" class="links">HOME</a></li>
            <li><a href="http://localhost/library/books/display.php"
                style="font-size: 15px;" class="links">BOOKS LIST</a></li>
            <li><a href = "http://localhost/library/books/borrowed.php" class="links">BORROWED</a></li>
        </ul>
        
        <div class = "admin-intro">Admin: <?= strtoupper($_SESSION['email']) ?></div>

        <div class = "update-container">
            <button class="update-button" name="approve"><a href="approve.php">Registration(s)
                <?php  
                    $conn=new mysqli('localhost', 'root', '', 'businessdb');
                    $query = "SELECT * FROM user WHERE status='pending'";
                    $result = mysqli_query($conn, $query);
                    $count = mysqli_num_rows($result);
                    echo":  {$count}";
                ?>
            </a></button>
            
            <button class="update-button" name="approve_book"><a href="approve_book.php">Borrowing(s)
                <?php  
                    $conn=new mysqli('localhost', 'root', '', 'businessdb');
                    $query = "SELECT * FROM borrowing WHERE status='pending'";
                    $result = mysqli_query($conn, $query);
                    $count = mysqli_num_rows($result);
                    echo":  {$count}";
                ?>
            </a></button>

            <button class="update-button" name="feedback"><a href="feedback.php">Feedback(s)
                <?php  
                    $conn=new mysqli('localhost', 'root', '', 'businessdb');
                    $query = "SELECT * FROM feedback WHERE status='pending'";
                    $result = mysqli_query($conn, $query);
                    $count = mysqli_num_rows($result);
                    echo":  {$count}";
                ?>
            </a></button>

            <button class="update-button" name="notice" onclick="showNotice()">
                <a href="#notice">Notice(s)
                <?php  
                    $conn=new mysqli('localhost', 'root', '', 'businessdb');
                    $query = "SELECT * FROM noticeboard";
                    $result = mysqli_query($conn, $query);
                    $count = mysqli_num_rows($result);
                    echo":  {$count}";
                ?>
            </a></button>
        </div>
    </nav>

    <div id = "notice">
        <form method = "POST" action = "header.php">
            <?php
                $conn = new mysqli("localhost", "root", "", "businessdb");

                $sql = "SELECT * FROM noticeboard";
                $result = mysqli_query($conn, $sql);

                echo"<div style='font-weight: bold; text-align:center; text-decoration: double underline'>";
                    echo"NOTICE BOARD";
                echo"</div>";
                echo "<ol>";
                    while($row = mysqli_fetch_assoc($result)){
                        echo "<li>" . $row['notice'] . "<input type='submit' name='delete' value='Delete'>";"</li>";

                        $id = $row['id'];
                        if(isset($_POST['delete'])){
                            $sql = "DELETE FROM noticeboard WHERE id = '$id'";
                            $result = mysqli_query($conn, $sql);
                            echo "<script>
                                window.location.href='admin_page.php';
                                alert('Notice deleted!');
                            </script>";
                        }
                    } 
                echo "</ol>";
            ?>
            <input type='submit' name='add' value='Add Notice' style="margin-left: 10px">
        </form>
    </div>
    
</header>

<script>
function showNotice(){
    var div = document.getElementById("notice");

    if (div.style.display === "none") {
        div.style.display = "block";
    } else {
        div.style.display = "none";
    }
}
</script>

</body>
</html>

<?php

    if (isset($_POST['add'])){
        echo"<script>window.location.href='notice.php'</script>";
    }

?>


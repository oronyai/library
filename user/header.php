<?php session_start();
    if ($_SESSION["user-login"] == false) {
        header("Location: library/index.php");
        exit();
    }

    if(isset($_POST['logout'])){
        session_destroy();
        header("location: library/index.php");
    }
?>

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
        color: white;
        font-family: arial narrow;
        font-size: 12px;
    }
    .navbar ul .admin-intro .admin-intro{
        display: inline-flex;
        text-align: center;
        color: white;
        font-weight: bold;
    }
    .navbar ul li{
        display: block;
        height: 50px;
        background-color: rgb(2, 47, 248);
        float: left;
        border-left: 1px white solid;
        border-right: 1px white solid;
        width:70px;
    }
    .navbar ul .admin-intro{
        display: block;
        border: none;
        margin-left: 553px;
        cursor: pointer;
        color: white;
        font-weight: bold;
        background-color: rgb(32, 56, 192);
        margin-top: 0px;
        width: 120px;
    }
    .navbar ul .admin-intro:hover{
        background-color: rgb(32, 56, 192);
        color: rgb(5, 255, 80);
    }
    .submenu{
        display: none;
        position:absolute;
        margin-left: 20px;
    }
    .navbar ul .admin-intro:hover .submenu{
        display:block;
        background: rgb(32, 56, 192);
        height: 150px;
        margin-top: -2px;
        padding: 0px;
        padding-right: 0px;
        margin-right: 100px;
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
        border-left: 2px solid white;
        border-right: 2px solid white;
        border-bottom: 2px solid white;
        width: 97px;
        
    }
    .submenu li a{
        text-decoration: none;
    }
    .pop-up-btn{
        background-color: rgb(32, 56, 192);
        border: none;
        width: 100px;
        height: 50px;
        font-weight: bold;
        color: white;
        cursor: pointer;
    }
    .pop-up-btn:hover{
        background-color: rgb(40, 120, 248);
    }
    .navbar ul li:hover{
        background-color: rgb(40, 120, 248);
    }
    .navbar ul li a:hover{
        color: black;
    }
    .navbar ul{
        list-style-type: none;
        background-color: rgb(32, 56, 192);
        margin-top: 0px;
        height: 30px;
        overflow: hidden;
    }
    header{
        text-align: center;
        background-color:rgb(0, 145, 255);
        height: 90px;
        max-width: 1000px;
        margin-left: auto;
        margin-right: auto;
        margin-top: -10px;
        position:absolute;
        z-index: 9999;
    }
    .sticky{
        position:sticky;
        top: 0;
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
    .profile{
        display: block;
        position: absolute;
        height: auto;
        z-index: 9999;
        margin-left: 440px;
        margin-top: -85px;
        border-radius: 45px;
        border: 4px double white;
    }
    .imgcontainer{
        display: block;
        position: absolute;
        height: auto;
        z-index: 9999;
        margin-left: 420px;
        border-radius: 45px;
    }
    .button-container{
        margin-left: 890px;
        margin-top: -18px;
    }
    .update-button{
        width: 90px;
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
    #notice, #comment{ 
        display: none;
        position: absolute;
        z-index: 9999;
        width: 400px;
        padding-right: 10px; 
        padding-top: 2px; 
        padding-bottom: 2px; 
        margin-top: 0px;
        margin-left: 580px; 
        background-color:rgb(0, 0, 0);
        border: 4px double white;
        border-radius: 5px;
        text-align: justify;
        color: white;
        animation: myAnim2;
        animation-duration: 2s;
        overflow: scroll;
    }
    #comment{ 
        margin-left: 0px;
        margin-top: -10px;
        max-height: 400px;
        
    }
    @keyframes myAnim2 {
        from{ opacity: 0%;}
        to {opacity: 100%;}
    }
    .forum-button{
        background-color: rgb(2, 47, 248);
        height: 50px;
        width:70px;
        border: none;
        color: white;
        font-family: arial narrow;
        font-weight: bold;
        margin-top: -10px;
    }
    .forum-button a{
        text-decoration: none;
    }
    .post{
        background-color: rgba(74, 74, 74, 0.61);
        border-radius: 10px;
        padding: 5px;
        margin-left: 10px;
        margin-bottom: 2px;
    }

</style>

<body>

    <?php
        require_once 'library/config.php';
        $sql = "SELECT * FROM user";
        $result = mysqli_query($conn, $sql);

        if($result){
            while ($row = mysqli_fetch_assoc($result)){
                $username = $row['username'];
                $profile = $row['profile'];
            }
        }
     ?>

<header class = "sticky">

    <div class = "headings">
        <span style="font-family: cambria; font-size:35px">
            Oronya's Library
        </span>
        <br>
        <span style="font-family:ans-serif; font-size: 20px">
            "Book the Book, Book the Future"
        </span>
    </div>

    <nav class = "navbar">
        <ul>
            <li>
                <a href="library/user/user_page.php" class="links">HOME</a>
            </li>
            <li>
                <a href="library/user/display.php" class="links">BOOKS LIST</a>
            </li>
            <li>
                <a href = "library/user/borrowed.php" class="links">BORROWED</a>
            </li>

            <li>
                <div class = "forum-button-container">
                    <button class="forum-button" name="forum" onclick="showComment()">
                        <a href="library/user/user_page.php#comment">FORUM</a></button>
                </div>
            </li>
            
            <li class="admin-intro">
                <?= strtoupper($_SESSION["username"])?>
                <ul class = "submenu">
                    <li> 
                        <form action="update.php" method="POST" enctype="multipart/form-data">
                            <button class = 'pop-up-btn'><a href  = 'update.php?update=$id'>Update Profile</a></button>
                        </form>
                    </li>
                    <li>
                        <form action="background.php" method="POST" enctype="multipart/form-data">
                            <button type='submit' class='pop-up-btn'><a href="background.php">Background</a></button>
                        </form> 
                    </li>
                    <li>
                        <form action="header.php" method="POST" enctype="multipart/form-data">
                            <button type='submit' class='pop-up-btn' name='logout'>Logout</button>
                        </form>
                    </li>
                </ul>
            </li>
             
        <div class="imgcontainer">
            <?php
                $username = $_SESSION["username"];
                $sql = "SELECT * FROM user WHERE username = '$username'";
                $result=mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($result)){
                $profile = $row['profile'];
                }
                echo "<img src='profile/" . $profile . "'class='profile' style='width: 80px; height: 80px; object-fit: cover; object-position:top' alt='Profile Image'>";
            ?>
        </div>
        </ul>  
    </nav>

    <!Pop-up contents of the forum tab>
    <div id = "comment">
        <form method="POST" action="library/user/header.php">
            <?php
                require_once 'library/config.php';

                $sql = "SELECT * FROM forum ORDER BY time DESC";
                $result = mysqli_query($conn, $sql);

                echo"<div style='font-weight: bold; text-align:center; text-decoration: double underline'>";
                    echo"USERS' FORUM";
                echo"</div>";

                echo "<button style='margin-left: 10px'>
                    <a href='forum.php' style='text-decoration:none; color:black;'>
                    Make Post
                </a></button>";

                    while($row = mysqli_fetch_assoc($result)){
                        echo "<div class='post'>";
                            echo "<div>";
                            echo "<span style='font-weight: bold; color:grey'>"
                                . strtoupper($row['username']) . 
                            "</span>";
                            
                            echo "<span style='font-weight: bold; color:grey'>";
                            echo ": ";
                            "</span>";

                            echo "<span style='font-weight: bold; color:red'>"
                                . strtoupper( $row['role']) . 
                            "</span>";
                        echo"</div>";

                        echo "<div style='font-family: courier new'>"
                                . $row['time'] . 
                            "</div>";

                        echo "<div style='font-family: times new roman'>"
                                . $row['comment'] . 
                            "</div>";
                        echo "</div>";
                    } 
            ?>

        </form>
    </div>

    <div class = "button-container">
            <button class="update-button" name="notice" onclick="showNotice()">
                <a href="#notice">Notice(s)
                <?php  
                    require_once 'library/config.php';
                    $query = "SELECT * FROM noticeboard";
                    $result = mysqli_query($conn, $query);
                    $count = mysqli_num_rows($result);
                    echo"<span=style'font-weight: bold'>";
                        echo":  {$count}";
                    echo"</span>";
                ?>
            </a></button>
        </div>
        
        <div id = "notice">
            <form method="POST" action="library/admin/header.php">
                <?php
                    require_once 'library/config.php';

                    $sql = "SELECT * FROM noticeboard";
                    $result = mysqli_query($conn, $sql);

                    echo"<div style='font-weight: bold; text-align:center; text-decoration: double underline'>";
                        echo"NOTICE BOARD";
                    echo"</div>";
                    echo "<ol>";
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<li>" . $row['notice'] . "</li>";
                        } 
                    echo "</ol>";
                ?>
            </form>
        </div>

</header>

<script>
    function showComment(){
        var div = document.getElementById("comment");

        if (div.style.display === "none") {
            div.style.display = "block";
        } else {
            div.style.display = "none";
        }
    }

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


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
    .admin-intro{
        display:fixed;
        font-size: 15px;
        font-family: arial narrow;
        text-align: center;
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
    #comment{ 
        display: none;
        position: absolute;
        z-index: 9999;
        width: 400px;
        overflow: scroll;
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
        overflow: scroll;
    }
    @keyframes myAnim2 {
        from{ opacity: 0%;}
        to {opacity: 100%;}
    }
    #comment{ 
        margin-left: 465px;
        margin-top: 7px;
        max-height: 400px;
    }
    .forum-button{
        display: block;
        height: 50px;
        background-color: rgb(0, 14, 74);
        float: left;
        width:140px;
        font-family: arial;
        font-weight: bold;
        font-size: 16px;
    }
    .forum-button:hover{
        background-color: rgb(40, 120, 248);
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
            <li><a href="../admin/admin_page.php" class="links">HOME</a></li>
            <li><a href="display.php"
                style="font-size: 15px;" class="links">BOOKS LIST</a></li>
            <li><a href = "borrowed.php" class="links">BORROWED</a></li>
            
            <li>
                <div class = "forum-button-container">
                    <button class="forum-button" name="forum" onclick="showComment()">
                        <a href="#comment">FORUM</a></button>
                </div>
            </li>
        </ul>

            <div class = "admin-intro">Admin: <?= strtoupper($_SESSION['email']) ?></div>
    </nav>

    <!Pop-up contents of the forum tab>
    <div id = "comment">
        <form method="POST" action="../admin/header.php">
            <?php
                require_once ('../config.php');

                $sql = "SELECT * FROM forum ORDER BY time DESC";
                $result = mysqli_query($conn, $sql);

                echo"<div style='font-weight: bold; text-align:center; text-decoration: double underline'>";
                    echo"USERS' FORUM";
                echo"</div>";

                echo "<button style='margin-left: 10px'>
                    <a href='../admin/forum.php' style='text-decoration:none; color:black;'>
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

                        $id = $row['id'];
                        echo "<button><a href='deleteComment.php?deleteCommentid=$id' style='text-decoration:none; color:black;'>
                        Delete</a></button>";
                    echo "</div>";   
                }
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
    </script>

</body>
</html>
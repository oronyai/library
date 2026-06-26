
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
    </nav>
    
</header>

</body>
</html>
<?php
    session_start();
    require_once 'library/config.php';
    $username = $_SESSION['username'];
    
    $sql = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $bg_img = $row['background'];

    
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
    <title>Books List</title>
    
</head>
    <style>

        body{
        background-color: aliceblue;
        width: 1000px;
        margin-left: auto;
        margin-right: auto;
        }
        .page-container{
            width: 1000px;
            height: 100vhpx;
            background-image: url('background/<?php echo $bg_img; ?>');
            background-size: cover;
            background-position: center;
        }
        button{
            width: 50px;
            height: auto;
            padding: 3px;
            border-radius: 3px;
            font-size: 10px;
        }
        button:hover{
            background-color: rgb(22, 191, 0);
        }
        a{
            text-decoration: none;
            color: white;
        }
        .addBtn{
            background-color: rgb(0, 0, 0);
            color: white;
            width: 100px;
        }
        .borrow{
            background-color: rgb(141, 252, 121);
            color: white;
        }
        .search-container{
            display: flex;
            align-items: center;
        }
        .search-input:hover{
            box-shadow: 1px 1px 1px rgb(252, 1, 1);
        }
        .search-input{
            padding: 10px;
            width: 250px;
            transition: box-shadow 0.3s;
            border: none;
            outline: none;
        }
        .searchBtn{
            padding: 10px;
            background-color: rgb(30, 126, 252);
            border: none;
            outline: none;
            height: 38px;
            cursor: pointer;
        }
        .searchBtn:hover{
            background-color: rgb(45, 62, 241);
        }
        .bookArray{
            display:grid;
            box-shadow: 3px 3px 3px black;
            width:150px;
        }
        .book-container{
            margin-bottom: 35px;
            width:150px;
            height:fit-content;
            padding: 5px;
            padding-bottom: 10px;
            text-align: center;
        }
        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: auto;
        }
        .action{
            line-height: 1px;
            font-family: times new roman;
            font-weight: bold;
        }
        .action-link{
            color: black;
        }
        .action-link:hover{
            color: white;
        }
 
    </style>

<body>
<?php include ("header.php"); ?>

<div class="page-container"><br>
        <span style="font-size: 25px;">
            <center><b>AVAILABLE BOOKS</b></center>
        </span>

    <!Search query>
    
    <div>
        <?php echo $error_message; ?>
    </div>

    <form action="" method="GET">
        <div class = "search-container" id="search">
            <input type="search" name="search" placeholder="Find a book"  class="search-input" value="<?php if(isset($_GET['search'])){echo $_GET['search'];}?>">
            <button type="submit" class="searchBtn" onclick="showTable()">Search</button>
        </div>
    </form>

    <div class="grid-container">
        <?php
            require_once 'library/config.php';
            
            if(isset($_GET['search'])){
                $filtervalues = $_GET['search'];
                $sql = "SELECT * FROM book WHERE CONCAT(id, title, cover, book_id, acquired) LIKE '%$filtervalues%'";
                $result = mysqli_query($conn, $sql);

                $row = mysqli_fetch_assoc($result);
                    $id = $row['id'];
                    $cover = $row['cover'];    
                    $title = $row['title'];
                    $book_id = $row['book_id'];

                
                if($row > 0){
                    foreach($result as $items){
                        echo "<div class='book-container'>";
                            echo "<div class='bookArray'>";
                                echo "<img src='library/books/covers/" . $cover . "'style='width: 150px; height:200px'>";
                            echo "</div>";

                            echo "<div class='action'>";
                            echo "<p style='font-family: arial; color: grey'>" . $book_id . "</p>"; 
                            echo " <button class='borrow'><a class='action-link' href='borrow.php?borrowid=$id'>Borrow</a></button>";
                            echo "</div>";
                        echo "</div>";
                    }
                }
                else
                {
                    echo "<div>";
                        echo "Sorry! <i>{$_GET['search']}</i> was not found.";
                    echo "</div>";
                }
            }
        ?>
    </div>

            
    <!Books display>
    <div class="grid-container">
        <?php
            include ("connect.php");
            require_once 'library/config.php';

            $sql = "SELECT * FROM book";
            $result=mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)){
                $id = $row['id'];
                $cover = $row['cover'];    
                $title = $row['title'];
                $book_id = $row['book_id'];

            echo "<div class='book-container'>";
                echo "<div class='bookArray'>";
                    echo "<img src='library/books/covers/" . $cover . "'style='width: 150px; height:200px'>";
                echo "</div>";

                echo "<div class='action'>";
                echo "<p style='font-family: arial; color: grey'>" . $book_id . "</p>"; 
                echo " <button class='borrow'><a class='action-link' href='borrow.php?borrowid=$id'>Borrow</a></button>";
                echo "</div>";
            echo "</div>";
            }
        ?>
    </div>

</div>
<?php include("footer.php"); ?>

</body>
</html>

<?php
    $pdf = "documents/sample.pdf";
?>
<?php
    session_start();
    if ($_SESSION["admin-login"] == false) {
        header("Location: ../admin/login.php");
        exit();
    }

    error_reporting(0);
    ini_set('display_errors', 0);

    $error_message = "";

    function customError($errno, $errstr, $errfile, $errline)
    {
        global $error_message;
        $error_message = "Sorry! <i>{$_GET['search']}</i> was not found. <br><hr>";
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
        background-color: rgb(65, 221, 252);
        width: 1000px;
        margin-left: auto;
        margin-right: auto;
        }
        .formcontainer{
            margin-left: auto;
            margin-right: auto;
            max-width: 1000px;
        }
        .page-container{
            background-color: aliceblue;
            margin-top: -10px;
        }
        button{
            width: 50px;
            height: auto;
            padding: 3px;
            border-radius: 3px;
            font-size: 10px;
        }
        .buttons{
            width: auto;
            height: auto;
            padding-left: 6px;
            padding-right: 6px;
            border-radius: 3px;
            font-size: 15px;
            font-weight: bold;
            color: white;
            text-align:left;
            background-color: rgb(22, 69, 255);
        }
        .counter{
            width: auto;
            height: auto;
            padding-left: 6px;
            padding-right: 6px;
            border-radius: 3px;
            font-size: 15px;
            font-weight: bold;
            color: white;
            text-align:left;
            background-color: rgb(22, 69, 255);
        }
        .counter:hover{
            background-color: rgb(22, 69, 255);
        }
        button:hover{
            background-color: rgb(14, 121, 0);
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
        .view{
            background-color: rgb(0, 206, 93);
        }
        .delete{
            background-color: rgb(232, 0, 0);
        }
        .search-container{
            display: flex;
            align-items: center;
        }
        .search-input:hover{
            box-shadow: 1px 1px 1px rgb(0, 0, 0);
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
            background-color: rgb(7, 90, 199);
        }
        .bookArray{
            display:grid;
            box-shadow: 3px 3px 3px black;
            width:150px;
        }
        .book-container{
            margin-bottom: 35px;
            border: 2px solid aliceblue;
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
            word-spacing: 30px;
        }
        .action-link{
            color: white;
        }
        .book_stats:hover{
            color:grey;
        }
    </style>

<body>
<?php include ("header.php"); ?><br><br>

<div class="page-container">
    <div class="formcontainer">
        <button class="counter"><u>BOOK STATS</u> <br>
            <a href = "" class = "book_stats">Total
                <?php  
                    require_once ('../config.php');
                    $query = "SELECT * FROM book";
                    $result = mysqli_query($conn, $query);
                    $count = mysqli_num_rows($result);
                    echo"<span=style'font-weight: bold'>";
                        echo":  {$count}";
                    echo"</span>";
                ?>   |
            </a>

            <a href = "borrowed.php" class = "book_stats">Borrowed
                <?php  
                    require_once ('../config.php');
                    $query = "SELECT * FROM borrowing WHERE status = 'approved'";
                    $result = mysqli_query($conn, $query);
                    $count = mysqli_num_rows($result);
                    echo"<span=style'font-weight: bold'>";
                        echo":  {$count}";
                    echo"</span>";
                ?>   |
            </a>

            <a href = "../admin/approve_book.php" class = "book_stats">Requested
                <?php  
                    require_once ('../config.php');
                    $query = "SELECT * FROM borrowing WHERE status = 'pending'";
                    $result = mysqli_query($conn, $query);
                    $count = mysqli_num_rows($result);
                    echo"<span=style'font-weight: bold'>";
                        echo":  {$count}";
                    echo"</span>";
                ?>
            </a>
        </button>

        <span style="font-size: 25px;">
            <center><b>AVAILABLE BOOKS</b></center>
        </span>

        <!Search query>

        <form action="" method="GET">
            <div class = "search-container" id="search">
                <input type="search" name="search" placeholder="Find a book"  class="search-input" value="<?php if(isset($_GET['search'])){echo $_GET['search'];}?>">
                <button type="submit" class="searchBtn" onclick="showTable()">Search</button>
            </div>
        </form>

        <div class="grid-container">

            <?php
                require_once ('../config.php');

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
                                    echo "<img src='covers/" . $cover . "'style='width: 150px; height:200px'>";
                                echo "</div>";

                                echo "<div class='action'>";
                                echo "<p style='font-family: arial; color: grey'>" . $book_id . "</p>"; 
                                echo "<button class='view'><a class='action-link' href='bookFiles/".$row['title']."' target='_blank'>View</a></button>
                                    <button class='delete'><a class='action-link' href='delete.php?deleteid=$id'>Delete</a></button>";
                                echo "</div>";
                            echo "</div>";
                        }
                    }
                }
            ?>
    </div>
   
    <!Books display>

    <div>
        <?php echo $error_message; ?>
    </div>

        <div class = "formcontainer">
            <form action="display.php" method="POST" enctype="multipart/form-data">
                
            <button class = "addBtn"><a href="form.php">Add Book</a></button>
            </form>

        </div>
    </div>
    <div class="grid-container">
        <?php
            include ("connect.php");
            require_once ('../config.php');

            $sql = "SELECT * FROM book";
            $result=mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)){
                $id = $row['id'];
                $cover = $row['cover'];    
                $title = $row['title'];
                $book_id = $row['book_id'];

            echo "<div class='book-container'>";
                echo "<div class='bookArray'>";
                    echo "<img src='covers/" . $cover . "'style='width: 150px; height:200px'>";
                echo "</div>";

                echo "<div class='action'>";
                echo "<p style='font-family: arial; color: grey'>" . $book_id . "</p>"; 
                echo "<button class='view'><a class='action-link' href='bookFiles/".$row['title']."' target='_blank'>View</a></button>
                    <button class='delete'><a class='action-link' href='delete.php?deleteid=$id'>Delete</a></button>";
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


<?php
    session_start();
    if ($_SESSION["admin-login"] == false) {
        header("Location: library/admin/login.php");
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
            margin-top: -10px;
            max-width: 1000px;
            background-color: aliceblue;
        }
        .withdraw:hover{
            background-color: rgb(175, 0, 0);
        }
        a{
            text-decoration: none;
            color: white;
        }
        .withdraw{
            background-color: rgb(223, 92, 49);
            color: white;
            border-radius: 3px;
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
            background-color: rgb(2, 83, 205);
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
        .book_stats:hover{
            color:grey;
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
            margin-top: 15px;
            margin-bottom: 15px;
        }
 
    </style>

<body>
<?php include ("header.php"); ?><br><br>
<div class="formcontainer">

    <button class="buttons"><u>BOOK STATS</u> <br>
        <a href = "display.php" class = "book_stats">Total
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

        <a href = "" class = "book_stats">Borrowed
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
        <center><b>BOOKS CURRENTLY BORROWED</b></center>
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
                $sql = "SELECT * FROM borrowing WHERE CONCAT(book_title) LIKE '%$filtervalues%'";
                $result = mysqli_query($conn, $sql);

                $row = mysqli_fetch_assoc($result);
                    $id = $row['id'];  
                
                if($row > 0){
                    foreach($result as $items){
                        echo "<div class='book-container'>";
                            echo "<div class='bookArray'>";
                                echo "<img src='covers/" . $row['cover'] . "'style='width: 150px; height:200px'>";
                            echo "</div>";

                            echo "<div class='action'>";
                            echo "Expiry: ";
                            echo "<p style='font-family: arial; color: grey'>" . $row['due_date'] . "</p>";
                            echo "<p style='font-family: arial; color: black'>" . $row['username'] . "</p>";
                            echo "<button class='withdraw'><a class='action-link' href='withdraw.php?withdrawid=$id'>Withdraw</a></button>";
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

    <div class="grid-container">
        <?php
            require_once ('../config.php');

                $sql = "SELECT * FROM borrowing WHERE status = 'approved'";
                $result=mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($result)){
                    $id = $row['id'];
                    $book_title = $row['book_title'];
                    $cover = $row['cover'];    
                    $due_date = $row['due_date'];
                    $status = $row['status'];

                echo "<div class='book-container'>";
                    echo "<div class='bookArray'>";
                        echo "<img src='covers/" . $cover . "'style='width: 150px; height:auto'>";
                    echo "</div>";

                    echo "<div class='action'>";
                        echo "Expiry: ";
                        echo "<p style='font-family: arial; color: grey'>" . $row['due_date'] . "</p>";
                        echo "<p style='font-family: arial; color: black'>" . $row['username'] . "</p>";
                        echo "<button class='withdraw'><a class='action-link' href='withdraw.php?withdrawid=$id'>Withdraw</a></button>";
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
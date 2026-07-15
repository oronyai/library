<?php
    session_start();
    if ($_SESSION["admin-login"] == false) {
        header("Location: http://localhost/library/admin/login.php");
        exit();
    }

    include ("connect.php");
    $conn = mysqli_connect('localhost', 'root', 'Ruth@0002', 'businessdb');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Approval</title>
</head>
<style>
    body{
        background-color: rgb(65, 221, 252);
        width: 1000px;
        margin-left: auto;
        margin-right: auto;
    }
    #button{
        width: 60px;
        height: auto;
        padding: 3px;
        border-radius: 3px;
        font-size: 10px;
        margin-top: 10px;
    }
    #button:hover{
        background-color: rgb(22, 69, 255);
    }
    a{
        text-decoration: none;
        color: white;
    }
    .approve{
        background-color: rgb(2, 199, 68);
        color: white;
        cursor: pointer;
    }
    .deny{
        background-color: rgb(173, 1, 1);
        color: white;
    }
    .book-container{
        margin-bottom: 35px;
        width:150px;
        height:fit-content;
        text-align: center;
        line-height: 1px;
    }
    .grid-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: auto;
    }
    .page-container{
        background-color: aliceblue;
        margin-top: -10px;
    }
    form{
        margin-top: -40px;
    }
    
</style>

<body>
    <?php
        include ("header.php");
    ?>

<div class = "page-container"><br><br>
    <h2 style="text-align: center;">Pending Book Request(s) </h2>

    <div class="grid-container">
        <?php
            $query = "SELECT * FROM borrowing WHERE status='pending' ORDER BY due_date DESC";
            $result = mysqli_query($conn, $query);

            while($row = mysqli_fetch_assoc($result)){
        ?>
        <div class="book-container">
            
            <?php echo "<div class='book-container'>"; ?>
                <?php echo "<div class='bookArray'>"; ?>
                    <?php echo "<img src='http://localhost/library/books/covers/" . $row['cover'] . "'style='width: 150px; height:auto'>"; ?>
                <?php echo "</div>"; ?>
            <?php echo "</div>"; ?>

            <form action="approve_book.php" method="POST">
                <input type = "hidden" name = "id" value = "<?php echo $row['id']; ?>"/>
                <input type = "submit" name = "approve_book" class = "approve" id = "button" value = "Approve"/>
                <input type = "submit" name = "deny" class = "deny" id = "button" value = "Deny">
            </form>

        </div>

        <?php
            }
        ?> 
    </div>
</div>

<?php
    include ("footer.php");
?>

</body>
</html>

<?php
    $query = "SELECT * FROM borrowing WHERE status='pending'";
    $result = mysqli_query($conn, $query);

    if (isset($_POST['approve_book'])){

        $id = $_POST['id'];
        $sql = "UPDATE borrowing
        SET due_date = DATE_ADD(CURDATE(), INTERVAL 30 DAY), status='approved' WHERE id='$id'";
        $result = mysqli_query($conn, $sql);

        if($result){
            echo "<script>
                window.location.href = 'http://localhost/library/admin/approve_book.php'; alert('Borrowing approved!')
            </script>";
        }
    }
    
    if (isset($_POST['deny'])){
        $id = $_POST['id'];
        $sql = "DELETE FROM borrowing WHERE id='$id'";
        $result = mysqli_query($conn, $sql);

        if($result){
            echo "<script>
            window.location.href = 'http://localhost/library/admin/approve_book.php'; alert('Request declined!')
        </script>";
        }
    }

$pdf = "documents/sample.pdf";
?>
<?php
    session_start();
    if ($_SESSION["admin-login"] == false) {
        header("Location: library/admin/login.php");
        exit();
    }

    require_once 'library/config.php';
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
    }
    #button:hover{
        background-color: rgb(151, 0, 0);
    }
    a{
        text-decoration: none;
        color: white;
    }
    .view-all-comment-link{
        background-color: black;
        color: white;
        border: 4px double white;
        padding: 10px;
        border-radius: 15px;
        margin-top: 25px;
        margin-bottom: 10px;
    }
    .view-all-comment-link:hover{
        background-color: rgb(54, 54, 54);
    }
    .delete{
        background-color: rgb(173, 1, 1);
        color: white;
        margin-bottom: 30px;
    }
    .readBtn:hover{
        color: black;
        background-color: white;
    }
    .readBtn{
        color: white;
        background-color: black;
        padding: 4px;
        border-radius: 10px;
        font-size: 10px;
    }
    .comment{
        border: 2px solid  aliceblue;
        width:200px;
        height:fit-content;
        text-align: left;
        line-height: 20px;
    }
    .date{
        border: 2px solid aliceblue;
        width:200px;
        height:fit-content;
        text-align: left;
        line-height: 20px;
        color:grey;
        font-weight: bold;
        margin-bottom: 10px;
    }
    .enrolment{
        border: 2px solid  aliceblue;
        width:150px;
        height:fit-content;
        text-align: center;
        font-weight: bold;
    }
    .grid-container {
        display: grid;
        grid-template-columns: repeat(4, minmax(180px, 1fr));
        gap: 25px;
        margin-left: 10px;
        margin-right: 10px;
    }
    .general-container{
        box-shadow: 2px 2px 2px black;
        border-radius: 5px;
        padding-left: 10px;
        padding-right: 10px;
    }
    .page-container{
        background-color: aliceblue;
        margin-top: -10px;
    }
    .action{
        display: relative;
        margin-top: 30px;


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
    <h2 style="text-align: center;">User Feebacks </h2>

    <div class="grid-container">
        <?php
            $query = "SELECT * FROM feedback WHERE status='pending' ORDER BY date DESC";
            $result = mysqli_query($conn, $query);

            while($row = mysqli_fetch_assoc($result)){
        ?>
        <div class="general-container">
            <?php echo "<div class='user-container'>"; ?>
                <?php echo "<div class='enrolment'>"; ?>
                    <?php echo $row['enrolment']; ?>
                <?php echo "</div>"; ?>

                <?php echo "<div class='comment'>"; ?>
                    <?php echo $row['comment']; ?>
                <?php echo "</div>"; ?>

                <?php echo "<div class='date' style='text-align: center'>"; ?>
                    <?php echo $row['date']; ?>
                <?php echo "</div>"; ?>

                <?php echo "<p style='font-weight: bold; margin-bottom: 30px;'>"; ?>
                    <?php echo"Have you read this comment?"; ?>
                <?php echo "</p>"; ?>

                <form action="feedback.php" method="POST">
                    <input type = "hidden" name = "id" value = "<?php echo $row['id']; ?>"/>
                    <input type = "radio" name = "read" value = "pending"> No yet
                    <input type = "radio" name = "read" value = "read"> Yes!
                    <input type = "submit" name = "read" class = "readBtn" value="OK">
                </form>

            <?php echo "</div>"; ?>
            <div class="action">
                <form action="feedback.php" method="POST">
                    <input type = "hidden" name = "id" value = "<?php echo $row['id']; ?>"/>
                    <input type = "submit" name = "delete" class = "delete" id = "button" value = "Delete">
                </form>
            </div>
        </div>

        <?php
            }
        ?>
    </div>

    <button onclick = "document.location='feedback_archived.php'" class = "view-all-comment-link">View archived comments</button>
</div>

<?php
    include ("footer.php");
?>

</body>
</html>

<?php
    $query = "SELECT * FROM feedback WHERE status='pending'";
    $result = mysqli_query($conn, $query);

    if (isset($_POST['read'])){
        $id = $_POST['id'];
        $sql = "UPDATE feedback SET status = 'read' WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);

        if($result){
            echo "<script>
                window.location.href = 'feedback.php'; alert('Comment Archived!')
            </script>";
        }
    }

    if (isset($_POST['delete'])){
        $id = $_POST['id'];
        $sql = "DELETE FROM feedback WHERE id='$id'";
        $result = mysqli_query($conn, $sql);

        if($result){
            echo "<script>
                window.location.href = 'feedback.php'; alert('Comment Deleted!')
            </script>";
        }
    }
?>
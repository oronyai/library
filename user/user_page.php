<?php
    session_start();
    $conn = new mysqli("localhost", "root", "Ruth@0002", "businessdb");
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

    }

    set_error_handler("customError");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>

    <style>
        .page-container{
            width: 1000px;
            height: 100vhpx;
            background-image: url('background/<?php echo $bg_img; ?>');
            background-size: cover;
            background-position: center;
        }
        .logout{
            background-color: rgb(215, 90, 45);
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            border: 2px solid white;
            margin-top: 5px;
        }
        .submit{
            background-color: rgb(76, 96, 227);
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            border: 2px solid white;
            margin-top: 5px;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        body{
            background-color: aliceblue;
            width: 1000px;
            margin-left: auto;
            margin-right: auto;
        }
        .welcome{
            max-width: 750px;
            padding-left: 10px; 
            padding-right: 10px; 
            padding-top: 2px; 
            padding-bottom: 2px; 
            margin-top: -20px; 
            background-color:rgb(0, 4, 255);
            opacity: 60%;
            border-radius: 15px;
            color: white
        }
        textarea{
            width: 500px;
            height: 150px;
            border-radius: 10px;
            text-align: center;
            word-wrap: break-word;
        }
        .buttons-container{
            margin-top: 40px;
        }
        h1{
            margin-top: -35px;
            text-shadow: 1.5px 0 1.5px white;
            text-align: center;
        }
    </style>
    
</head>

<body>
<?php include("header.php"); ?>

<div class = "page-container">
    <div class = "container">
        <form action="user_page.php" method="POST" enctype="multipart/form-data">

            <h1>Welcome, 
                <?php $conn=new mysqli('localhost', 'root', 'Ruth@0002', 'businessdb');
                    $username = $_SESSION['username'];
                    $query = "SELECT * FROM user WHERE username = '$username'";
                    $result = mysqli_query($conn, $query);
                    $row = mysqli_fetch_assoc($result);
                    echo "<span style='color: darkblue'>";
                    echo strtoupper($row['username']);
                    echo "</span>";
                ?>; you are in the right place!
            </h1>

            <div class="welcome">
                <b><p>Times have changed, your time is more valuable than ever and you need knowledge; we know that! Anywhere, anytime you can grab a book but not all books are good for you! So, you are indeed in the right place.<br>
                NOTE: Books will be widthrawn on the indicated due date (i.e. after 30 DAYS) unless under exceptional circumstances.
                We have books of the following genres: <br>
                Education, Religion, Politics, Technology, Finance, History, Fiction, Folktales, Children, etc. <br>

                <span style='color:red;'>We take EXCEPTION on books that promote pornography, violence, drug abuse, immorality, Anti-Monotheism and other diabolical or perverse subjects</span><br>

                <i>Always Book the Right Book!</i></p></b>
            </div>

            <div class="buttons-container">
                <textarea class="comment" name="comment" placeholder="Please, leave a comment"></textarea><br>
                <input type="submit" class="submit" name="submit" value="Submit"><br><br>
            </div>
            
        </form>
    
    </div>
</div>

<?php include("footer.php"); ?>

</body>
</html>

<?php
    if(isset($_POST["submit"])){
        $comment = filter_input(INPUT_POST, "comment", FILTER_SANITIZE_SPECIAL_CHARS);
        $sql = "INSERT INTO feedback (enrolment, comment)
                SELECT enrol, '$comment'
                FROM user WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);

        if($result){
            echo "<script>
                window.location.href='Location: user_page.php'; alert('Comment submitted successfully!');
            </script>";
        }
        else {
            echo "Error! Your comment was NOT SUBMITTED!";
        }
    }
?>
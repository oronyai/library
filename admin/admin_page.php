<?php
    session_start();
    if ($_SESSION["admin-login"] == false) {
        header("Location: http://localhost/library/admin/login.php");
        exit();
    }

    $conn = new mysqli("localhost", "root", "", "businessdb");
    $email = $_SESSION['email'];
    $sql = "SELECT * FROM admin WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($result);
    $bg_img = $row['background'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Control Panel</title>
</head>

    <style>
        .page-container{
            margin-top: -15px;
            width: 1000px;
            height: 100vhpx;
            background-image: url('background/<?php echo $bg_img; ?>');
            background-size: cover;
            background-position: center;
        }
        .buttons{
            background-color: rgb(0, 135, 254);
            color: white;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
            margin-top: -10px;
        }
        .update-button{
            color: white;
            text-decoration: none;
        }
        .logout{
            background-color: rgb(219, 67, 37);
            color: white;
            padding: 10px 20px;
            cursor: pointer;
            border: 2px solid white;
            border-radius: 5px;
            margin-top: 20px;
        }
        .container {
            height: 100vh;
            width: 1000px;
            margin-left: auto;
            margin-right: auto;
        }
        body{
            background-color: rgb(160, 239, 255);
            width: 1000px;
            margin-left: auto;
            margin-right: auto;
        }
        .welcome{
            font-size: 18px;
        }
        .instruction{
            max-width: 1000px;
            padding-left: 10px; 
            padding-right: 10px;
            padding-top: 2px; 
            padding-bottom: 2px; 
            margin-top: -20px; 
            background-color:rgb(255, 255, 255);
            border-radius: 15px;
            text-align: justify;
            line-height: 1.8;
            opacity: 70%;
        }
        .update-bg-btn{
            background-color: black;
            color: white;
            border: 4px double white;
            padding: 10px;
            border-radius: 15px;
            margin-top: 25px;
            margin-bottom: 10px;
        }
        .update-bg-btn:hover{
            background-color: rgb(54, 54, 54);
        }
        a{
            text-decoration: none;
            color: white;
        }
    </style>

<body>
    <?php
        include ("header.php");
    ?>

<div class = "page-container"><br><br>

    <form action="admin_page.php" method="POST" enctype="multipart/form-data">
    <div class="imgcontainer">
        <div class = "container">

        <br>
        <h1 style='margin-top: -10px; text-shadow: 2px 0 2px white'><center>Welcome 
                <?php $conn=new mysqli('localhost', 'root', '', 'businessdb');
                    $email = $_SESSION['email'];
                    $query = "SELECT * FROM admin WHERE email = '$email'";
                    $result = mysqli_query($conn, $query);
                    $row = mysqli_fetch_assoc($result);
                    echo "<span style='color: darkblue'>";
                    echo strtoupper($row['firstName']);
                    echo "</span>";
                ?>,
                    to Oronya's Library!
            </center></h1>

            <div class="instruction">
                <p><b>As you work with us, please serve diligently, ensuring that everyone who deserves to read, reads. Go through our books yourself and get some basic information about them as users may need to consult you. <br>
                    Books should <u>STRICTLY BE WITHDRAWN</u> on the automated due date(after 30 days) except in special circumstances<br>
                    We have books of the following genres:
                    
                    <ul style='line-height: 25px;'>
                        <table>
                            <tr>
                                <td width="150"><li>Religion</li></td>
                                <td width="150"><li>Politics</li></td>
                                <td width="150"><li>Technology</li></td>
                            </tr>
                            <tr>
                                <td><li>Finance</li></td>
                                <td><li>Education</li></td>
                                <td><li>Folktales</li></td>
                            </tr>
                            <tr>
                                <td><li>History</li></td>
                                <td><li>Fiction</li></td>
                                <td><li>Children, etc.</li></td>
                            </tr>
                        </table>    
                    </ul>

                    <span style='color:red;'>DO NOT upload books that promote pornography, violence, drug abuse, immorality, Anti-Monotheism and other diabolical or perverse subjects</span><br>

                <i>Once again welcome to "Booking the Future!"</i></b></p>
            </div>

            <input type="submit" class="logout" name="logout" value="Logout">

        </div>
    </form>
</div>

<form action="background.php" method="POST" enctype="multipart/form-data">
    <button type='submit' class='update-bg-btn'><a href="background.php">Update Background Pic</a></button>
</form>   

    <?php include ("footer.php"); ?>
</body>
</html>

<?php
    $pdf = "documents/sample.pdf";

    if(isset($_POST["logout"])){
        session_destroy();
        header("Location: http://localhost/library/admin/login.php");
    }
?>



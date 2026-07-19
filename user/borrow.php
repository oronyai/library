<?php
    session_start();
    if ($_SESSION["user-login"] == false) {
        header("Location: ../index.php");
        exit();
    }
    
    include("connect.php");
    require_once ('../config.php');
    
    if(isset($_GET['borrowid'])){
        $id = $_GET['borrowid'];

        if(($_SESSION["user-login"]) == true) {
            $username = $_SESSION['username'];

            $sql = "INSERT INTO borrowing (username, book_title, cover)
                    SELECT '$username', title, cover
                    FROM book WHERE id = $id";
                    
            $result = mysqli_query($conn, $sql); 
            if($result){
                echo "<script>
                    window.location.href='display.php';
                    alert('Borrow request sent! Please wait for admin approval')
                </script>";
            } else {
                echo "<script>
                    window.location.href='display.php';
                    alert('Borrow request failed!')
                </script>";
            }
        }
    }
?>
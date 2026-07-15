<?php
    include("connect.php");
    $conn = mysqli_connect('localhost', 'root', 'Ruth@0002', 'businessdb');
    if(isset($_GET['deleteid'])){
        $id = $_GET['deleteid'];
        $sql = "DELETE FROM book WHERE id = $id";
        $result = mysqli_query($conn, $sql);

        if($result){
            echo "<script>
                window.location.href = 'display.php';
                alert('Book deleted successfully!');
            </script>";
        } else {
            die(mysqli_error($conn));
        }
    }
?>
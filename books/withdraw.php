<?php
    include("connect.php");
    $conn = mysqli_connect('localhost', 'root', '', 'businessdb');
    if(isset($_GET['withdrawid'])){
        $id = $_GET['withdrawid'];
        $sql = "DELETE FROM borrowing WHERE id = $id";
        $result = mysqli_query($conn, $sql);

        if($result){
            echo "<script>
                window.location.href = 'borrowed.php';
                alert('Book withdrawn successfully!');
            </script>";
        } else {
            die(mysqli_error($conn));
        }
    }
?>
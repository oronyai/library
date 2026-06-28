<?php
    $conn = mysqli_connect('localhost', 'root', '', 'businessdb');
    if(isset($_GET['deleteNoticeid'])){
        $id = $_GET['deleteNoticeid'];
        $sql = "DELETE FROM noticeboard WHERE id = $id";
        $result = mysqli_query($conn, $sql);

        if($result){
            echo "<script>
                window.location.href = 'admin_page.php';
                alert('Notice deleted!');
            </script>";
        } else {
            die(mysqli_error($conn));
        }
    }
?>
<?php
    $conn = mysqli_connect('localhost', 'root', 'Ruth@0002', 'businessdb');
    if(isset($_GET['deleteCommentid'])){
        $id = $_GET['deleteCommentid'];
        $sql = "DELETE FROM forum WHERE id = $id";
        $result = mysqli_query($conn, $sql);

        if($result){
            echo "<script>
                window.location.href = 'display.php';
                alert('Comment deleted!');
            </script>";
        } else {
            die(mysqli_error($conn));
        }
    }
?>
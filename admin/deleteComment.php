<?php
    require_once 'library/config.php';
    if(isset($_GET['deleteCommentid'])){
        $id = $_GET['deleteCommentid'];
        $sql = "DELETE FROM forum WHERE id = $id";
        $result = mysqli_query($conn, $sql);

        if($result){
            echo "<script>
                window.location.href = 'admin_page.php';
                alert('Comment deleted!');
            </script>";
        } else {
            die(mysqli_error($conn));
        }
    }
?>
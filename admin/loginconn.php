    <?php

    if(isset($_POST['logout'])){
        session_destroy();
        header("Location: login.php");
    }

    if(isset($_POST['switch-to-user'])){
        header("Location: ../index.php");
    }
?>
    <?php

    if(isset($_POST['logout'])){
        session_destroy();
        header("Location: admin_login.php");
    }

    if(isset($_POST['switch-to-user'])){
        header("Location: index.php");
    }
?>
<?php

    $conn = mysqli_connect('localhost', 'root', 'Ruth@0002', 'businessdb');
    
    if(isset($_POST['submit'])){
        $firstName = filter_input(INPUT_POST, "firstName", FILTER_SANITIZE_SPECIAL_CHARS);
        $lastName = filter_input(INPUT_POST, "lastName", FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $contact = filter_input(INPUT_POST, "contact", FILTER_SANITIZE_NUMBER_INT);

        $sql = "INSERT INTO admin(firstName, lastName, email, password, contact)
            VALUES('$firstName', '$lastName', '$email', '$password_hash', '$contact')";
            
        $mailsql = "SELECT * FROM admin WHERE email='$email'";

        if(mysqli_num_rows(mysqli_query($conn, $mailsql)) > 0){
            echo "<script>
                window.location.href = 'registration.php'; alert('Error! Email already registered')
            </script>";
        }
        else if(mysqli_query($conn, $sql)){
            echo "<script>
                window.location.href = 'login.php'; alert('Success! You can now log in')
            </script>";
        }
    }

    if(isset($_POST['display'])){
        header("Location: http://localhost/library/books/display.php");
    }

    if (isset($_POST['approve'])){
        header("Location: http://localhost/library/admin/approve.php");
    }

?>
<?php
    $conn = mysqli_connect('localhost', 'root', 'Ruth@0002', 'businessdb');
    if(!$conn){
        echo "Connection failed!";
    }

//ADD A NEW BOOK

    if(isset($_POST['submit'])){
        $book_id = filter_input(INPUT_POST, "book_id", FILTER_SANITIZE_SPECIAL_CHARS);

//Book file
        $title_name = $_FILES['title']['name'];
        $title_temp  = $_FILES['title']['tmp_name'];
        $title_size = $_FILES['title']['size'];
        $title_error = $_FILES['title']['error'];
        $title_type = $_FILES['title']['type'];

        $title_name = time() . "_" . $title_name;
        $title_folder = "bookFiles/" . $title_name;
        move_uploaded_file($title_temp, $title_folder);

//Book cover
        $cover_name = $_FILES['cover']['name'];
        $cover_temp  = $_FILES['cover']['tmp_name'];
        $cover_size = $_FILES['cover']['size'];
        $cover_error = $_FILES['cover']['error'];
        $cover_type = $_FILES['cover']['type'];

        $cover_name = time() . "_" . $cover_name;
        $cover_folder = "covers/" . $cover_name;
        move_uploaded_file($cover_temp, $cover_folder);

        $sql = "INSERT INTO book(title, cover, book_id) VALUES ('$title_name', '$cover_name', '$book_id')";   

        $result = mysqli_query($conn, $sql);
        if($result){
            echo "<script>
                window.location.href ='form.php'; alert('Book registered successfully')
            </script>";
        } else {
            echo "<script>
                window.location.href ='form.php'; alert('Book upload failed')
            </script>";
        }
    }
    
    if(isset($_POST['cancel'])){
        header("Location: display.php");
    }

    //UPDATE A BOOK
    if(isset($_POST['update'])){
        $book_id = filter_input(INPUT_POST, "book_id", FILTER_SANITIZE_SPECIAL_CHARS);
        $id = $_GET['id'];

//Book file
        $title_name = $_FILES['title']['name'];
        $title_temp  = $_FILES['title']['tmp_name'];
        $title_size = $_FILES['title']['size'];
        $title_error = $_FILES['title']['error'];
        $title_type = $_FILES['title']['type'];

        $title_folder = "bookFiles/" . $title_name;
        move_uploaded_file($title_temp, $title_folder);

//Book cover
        $cover_name = $_FILES['cover']['name'];
        $cover_temp  = $_FILES['cover']['tmp_name'];
        $cover_size = $_FILES['cover']['size'];
        $cover_error = $_FILES['cover']['error'];
        $cover_type = $_FILES['cover']['type'];

        $cover_folder = "covers/" . $cover_name;
        move_uploaded_file($cover_temp, $cover_folder);

        $sql = "UPDATE book
                SET title = '$title_name', cover = '$cover_name', book_id = '$book_id' WHERE id = $id";

        $result = mysqli_query($conn, $sql);
        if($result){
            echo "<script>
                window.location.href ='display.php'; alert('Book updated successfully')
            </script>";
        } else {
            echo "<script>
                window.location.href ='display.php'; alert('Book update failed')
            </script>";
        }
    }
?>
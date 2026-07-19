<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>upload</title>
</head>
<body>
    <form action="cover_upload.php" method="POST" enctype="multipart/form-data">
        <div class = "input-field" style="font-size: 14px; font-family: arial narrow;">
                Upload book (pdf) <br>
                <input type="file" name="title" class="file-input" accept="pdf/*">
                <input type="submit" class="upload" name="upload-book" value="Upload">
        </div>
    </form>
    
</body>
</html>

<?php
    require_once ('../config.php');
    if(isset($_POST['upload-book'])){
        $title_name = $_FILES['title']['name'];
        $title_temp  = $_FILES['title']['tmp_name'];
        $title_size = $_FILES['title']['size'];
        $title_error = $_FILES['title']['error'];
        $title_type = $_FILES['title']['type'];

        if($title_error == 0){
            $title_name = time() . "_" . $title_name;
            $title_folder = "bookFiles/" . $title_name;
            move_uploaded_file($title_temp, $title_folder);

            $sql="INSERT INTO book(title) VALUES ('$title_name')";
            $result=mysqli_query($conn, $sql);
            echo "<script> 
                alert('Book  uploaded!')
            </script>";
            } else {
                echo "<script> 
                alert('File error! Check book file')
                </script>";
            }
        }
?>
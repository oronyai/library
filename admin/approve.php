<?php
    session_start();
    if ($_SESSION["admin-login"] == false) {
        header("Location: http://localhost/library/admin/login.php");
        exit();
    }

    include ("connect.php");
    $conn = mysqli_connect('localhost', 'root', '', 'businessdb');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Approval</title>
</head>
<style>
    body{
        background-color: rgb(65, 221, 252);
        width: 1000px;
        margin-left: auto;
        margin-right: auto;
    }
    .tableContainer{
        max-width: 1000px;
        margin-left: auto;
        margin-right: auto;
        justify-content: center;
        display:block;
        height: auto;
    }
    .page-container{
        background-color: aliceblue;
        margin-top: -10px;
    }
    table {
            border-collapse: collapse;
            width: 1000px;
            margin-left: auto;
            margin-right: auto;
            line-height: 0.8;
            font-size: 14px;
            word-break: break-word;
        }
        th, td {
            padding: 3px;
            border-top: 2px solid #000000;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            border-bottom: 2px solid #000000;
            padding: 7px;
        }
        td, th {
            border-left: none;
            border-right: none;
        }
        td:last-child{
            text-align: center;
        }
        tr:first-child th {
            border-top: none;
        }
    #button{
        width: 60px;
        height: auto;
        padding: 3px;
        border-radius: 3px;
        font-size: 10px;
    }
    #button:hover{
        background-color: rgb(22, 69, 255);
    }
    a{
        text-decoration: none;
        color: white;
    }
    .approve{
        background-color: rgb(0, 130, 43);
        color: white;
    }
    .deny{
        background-color: rgb(224, 0, 0);
        color: white;
    }
    .view-all-approved-link{
        background-color: rgb(54, 54, 54);
        color: white;
        border: 4px double white;
        padding: 10px;
        border-radius: 15px;
        margin-top: 25px;
        margin-bottom: 10px;
        cursor: pointer;
    }
    .view-all-approved-link:hover{
        background-color: black;
    }
</style>

<body>
    <?php
        include ("header.php");
    ?>

<div class = "page-container"> <br><br>
    <div class="tableContainer">
        <h2 style="text-align: center;">Pending User(s)</h2>
        <table>
            <tr>
                <thead>
                    <th scope="col">ID</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Password</th>
                    <th scope="col">Contact</th>
                    <th scope="col">YR/SEM</th>
                    <th scope="col">Enrollment No.</th>
                    <th scope="col" style="text-align: center;">Action</th>
                </thead>
            </tr>
                <tbody>

                </tbody>
                    <tr>

                    </tr>

            <?php
                $query = "SELECT * FROM user WHERE status='pending' ORDER BY id ASC";
                $result = mysqli_query($conn, $query);

                while($row = mysqli_fetch_assoc($result)){
            ?>
                <tbody>
                    <tr>
                        <td style="max-width:10px;"><?php echo $row['id']; ?></td>
                        <td style="max-width:100px;"><?php echo $row['username']; ?></td>
                        <td style="max-width:150px;"><?php echo $row['email']; ?></td>
                        <td style="max-width:200px;"><?php echo $row['password']; ?></td>
                        <td style="max-width:70px;"><?php echo $row['contact']; ?></td>
                        <td style="text-align: center; max-width:60px;"><?php echo $row['sem']; ?></td>
                        <td style="max-width:100px;"><?php echo $row['enrol']; ?></td>
                        <td style="text-align: center; max-width:100px;">
                            <form action="approve.php" method="POST">
                                <input type = "hidden" name = "id" value = "<?php echo $row['id']; ?>"/>
                                <input type = "submit" name = "approve" class = "approve" id = "button" value = "approve"/>
                                <input type = "submit" name = "deny" class = "deny" id = "button" value = "Deny">
                            </form>
                        </td>
                    </tr>
                            <tr>

                            </tr>
                </tbody>

        <?php
        }
        ?>
    </div>

    <?php
        $query = "SELECT * FROM user WHERE status='pending'";
        $result = mysqli_query($conn, $query);

        if (isset($_POST['approve'])){
            $id = $_POST['id'];
            $sql = "UPDATE user SET status='approved' WHERE id='$id'";
            $result = mysqli_query($conn, $sql);

            if($result){
                echo "<script>
                    window.location.href = 'approve.php'; alert('User approved!')
                </script>";
            }
        }

        if (isset($_POST['deny'])){
            $id = $_POST['id'];
            $sql = "DELETE FROM user WHERE id='$id'";
            $result = mysqli_query($conn, $sql);

            if($result){
                echo "<script>
                window.location.href = 'approve.php'; alert('User denied!')
            </script>";
            }
        }
    ?>
    </table><br>

    <button onclick = "document.location='approved_users.php'" class = "view-all-approved-link">View All Current Users</button>
    <br><br>
</div>
    
    <?php
        include ("footer.php");
    ?>

</body>
</html>
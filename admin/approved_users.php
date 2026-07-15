<?php
    session_start();
    if ($_SESSION["admin-login"] == false) {
        header("Location: http://localhost/library/admin/login.php");
        exit();
    }

    include ("connect.php");
    $conn = mysqli_connect('localhost', 'root', 'Ruth@0002', 'businessdb');
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
    .page-container{
        background-color: aliceblue;
    }
    .tableContainer{
        max-width: 1000px;
        margin-left: auto;
        margin-right: auto;
        justify-content: center;
        display:block;
        height: auto;
    }
    table {
            border-collapse: collapse;
            width: 1000px;
            margin-left: auto;
            margin-right: auto;
            line-height: 0.8;
            font-size: 14px;
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
    .remove{
        background-color: rgb(224, 0, 0);
        color: white;
        width: auto;
        cursor: pointer;
        border-radius: 3px;
    }
    .remove:hover{
        background-color: rgb(111, 1, 1);
    }
    .view-all-approved-link{
        background-color: black;
        color: white;
        border: 4px double white;
        padding: 10px;
        border-radius: 15px;
        margin-top: 25px;
        margin-bottom: 10px;
        cursor: pointer;
    }
    .view-all-approved-link:hover{
        background-color: rgb(54, 54, 54);
    }
    .search-container{
        display: flex;
        align-items: center;
    }
    .search-input:focus-within{
        box-shadow: 1px 1px 1px rgb(252, 1, 1);
    }
    .search-input{
        padding: 10px;
        width: 250px;
        transition: box-shadow 0.3s;
        border: none;
        outline: none;
    }
    .searchBtn{
        padding: 10px;
        background-color: rgb(30, 126, 252);
        border: none;
        outline: none;
        height: 38px;
    }
</style>

<body>
<?php
    include ("header.php");
?>
<br>
<div class = "page-container"><br>
    <div class="tableContainer">
        <h2 style="text-align: center;">Registered User(s): 
            <?php  
                $conn=new mysqli('localhost', 'root', 'Ruth@0002', 'businessdb');
                $query = "SELECT * FROM user WHERE status='approved'";
                $result = mysqli_query($conn, $query);
                $count = mysqli_num_rows($result);
                echo"<span style = 'color: darkred'>";
                    echo"  {$count}";
                echo"</span>";
            ?>
        </h2>

        <form action="" method="GET">
            <div class = "search-container" id="search">
                <input type="search" name="search" placeholder="Find a user"  class="search-input" value="<?php if(isset($_GET['search'])){echo $_GET['search'];}?>">
                <button type="submit" class="searchBtn" onclick="showTable()">Search</button>
            </div>
        </form>

        <! Table for the search results >
        <div class = "tableContainer" id="search-tableContainer">
            <table>
                
                <tbody>
                    <?php
                        $conn = mysqli_connect('localhost', 'root', 'Ruth@0002', 'businessdb');
                        if(isset($_GET['search'])){
                            $filtervalues = $_GET['search'];
                            $sql = "SELECT * FROM user WHERE CONCAT(id, username, email, contact, sem, enrol) LIKE '%$filtervalues%'";
                            $result = mysqli_query($conn, $sql);

                            if(mysqli_num_rows($result) > 0){
                                foreach($result as $items){
                                    ?>
                                        <tr>
                                            <td><?= $items['id']; ?></td>
                                            <td><?= $items['username']; ?></td>
                                            <td><?= $items['email']; ?></td>
                                            <td><?= $items['contact']; ?></td>
                                            <td><?= $items['sem']; ?></td>
                                            <td><?= $items['enrol']; ?></td>
                                            <td></td>
                                        </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                    <tr>
                                        <td colspan="7"> Sorry, we don't have a user related to "<?= $_GET['search']; ?>" keyword! <br><hr> </td>
                                    </tr>
                                <?php
                            }
                        }
                    ?>
                    
                </tbody>
                    <tr>
                        
                    </tr>
            </table>
        </div>

        <! Original table>

        <table>
            <tr>
                <thead>
                    <th scope="col">ID</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Semester</th>
                    <th scope="col">Enrollment No.</th>
                    <th scope="col" style="text-align: center;">Action</th>
                </thead>
            </tr>
                <tbody>

                </tbody>
                    <tr>

                    </tr>

            <?php
                $query = "SELECT * FROM user WHERE status='approved' ORDER BY id DESC";
                $result = mysqli_query($conn, $query);

                while($row = mysqli_fetch_assoc($result)){
            ?>
                <tbody>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['contact']; ?></td>
                        <td><?php echo $row['sem']; ?></td>
                        <td><?php echo $row['enrol']; ?></td>
                        <td style="text-align: center;">
                            <form action="approved_users.php" method="POST">
                                <input type = "hidden" name = "id" value = "<?php echo $row['id']; ?>"/>
                                <input type = "submit" name = "remove" class = "remove" value = "Remove User">
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
        $query = "SELECT * FROM user WHERE status='approved'";
        $result = mysqli_query($conn, $query);

        if (isset($_POST['remove'])){
            $id = $_POST['id'];
            $sql = "DELETE FROM user WHERE id='$id'";
            $result = mysqli_query($conn, $sql);

            echo "<script>
                window.location.href = 'approved_users.php'; alert('User Removed!')
            </script>";
        }
    ?>


    </table><br>

    <button onclick = "document.location='approve.php'" class = "view-all-approved-link">View Pending User Requests</button>
    <br><br>
</div>
    
<?php
    include ("footer.php");
        
?>

</body>
</html>
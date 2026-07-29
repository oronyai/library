<?php

$conn =mysqli_connect("localhost","root","Ruth@0002","businessdb");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>
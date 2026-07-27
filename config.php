<?php

$host = 'sql312.infinityfree.com';
$port = 3306;
$db   = 'if0_42473575_businessdb';
$user = 'if0_42473575';
$pass = 'Ruth@0002';

$conn = new mysqli(
    $host,
    $user,
    $pass,
    $db,
    (int)$port
);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

?>
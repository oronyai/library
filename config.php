<?php

$host = getenv('DB_HOST') ? : 'localhost';
$port = getenv('DB_PORT') ? : 3306;
$db   = getenv('DB_NAME') ? : 'businessdb';
$user = getenv('DB_USER') ? : 'root';
$pass = getenv('DB_PASS') ? : 'Ruth@0002';

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
<?php

$db_host = getenv('bs8aufzm3auy0nulzfmv-mysql.services.clever-cloud.com');
$db_port = getenv(3306);
$db_name = getenv('bs8aufzm3auy0nulzfmv');
$db_user = getenv('uhym2ioae2mo5obq');
$db_pass = getenv('uhym2ioae2mo5obq');

$conn = new mysqli(
    $db_host,
    $db_user,
    $db_pass,
    $db_name,
    (int)$db_port
);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

?>
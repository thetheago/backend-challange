<?php

require_once "../vendor/autoload.php";

$host = getenv('DB_HOST');
$username = getenv('DB_USER');
$password = getenv('DB_PASS');
$dbName = getenv('DB_TEST_NAME');

$conn = new PDO(
    dsn: 'mysql:host=' . $host . ';dbname=' . $dbName,
    username: $username,
    password: $password
);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$GLOBALS['conn'] = $conn;

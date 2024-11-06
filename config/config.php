<?php
include 'env.php';

loadEnv(__DIR__ . '/../.env');
$servername = getenv('DB_SERVERNAME');
$username = getenv('DB_USERNAME');
$password = getenv('DB_PASSWORD');
$dbname = getenv('DB_NAME');
$timezone = getenv('DEFAULT_TIMEZONE');

date_default_timezone_set($timezone);

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

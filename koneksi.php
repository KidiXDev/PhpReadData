<?php
$servername = "localhost"; // Change this to your servername
$username = "root"; // Change this to your username
$password = ""; // Change this to your password
$dbname = "php_read_data"; // Change this to your database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
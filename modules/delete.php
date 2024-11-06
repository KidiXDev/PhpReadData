<?php
include 'config/config.php';

if (isset($_GET['id'])) {
    $id = isset($_GET['id']) && is_numeric($_GET['id']) ? $_GET['id'] : 0;

    $sql = "DELETE FROM barang WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/';
        header("Location: " . $referer);
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();

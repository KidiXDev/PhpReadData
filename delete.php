<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $page = $_GET['page'];
    $search = isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '';

    $sql = "DELETE FROM barang WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: index.php?search=" . $search . "&page=" . $page);
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();

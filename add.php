<?php
include 'session.php';
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_barang = $_POST['nama_barang'];
    $jumlah = $_POST['jumlah'];

    $harga = str_replace(['Rp ', '.'], '', $_POST['harga']);

    $stmt = $conn->prepare("INSERT INTO barang (nama_barang, jumlah, harga) VALUES (?, ?, ?)");
    $stmt->bind_param("sis", $nama_barang, $jumlah, $harga);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error inserting record: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Barang</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="container bg-white p-6 rounded-lg shadow-md w-full max-w-md">
        <h1 class="text-2xl font-semibold mb-6 text-center text-gray-800">Add Barang</h1>
        <form method="post" action="">
            <label for="nama_barang" class="block text-gray-700 font-bold mb-2">Nama Barang:</label>
            <input type="text" id="nama_barang" name="nama_barang" class="border border-gray-300 rounded-lg p-2 w-full mb-4" required>

            <label for="jumlah" class="block text-gray-700 font-bold mb-2">Jumlah:</label>
            <input type="number" id="jumlah" name="jumlah" class="border border-gray-300 rounded-lg p-2 w-full mb-4" required>

            <label for="harga" class="block text-gray-700 font-bold mb-2">Harga:</label>
            <input type="text" id="harga" name="harga" class="border border-gray-300 rounded-lg p-2 w-full mb-4" value="Rp " required>

            <div class="flex gap-8 mt-5">
                <input type="submit" value="Add" class="bg-green-500 text-white rounded px-4 py-2 w-full hover:bg-green-600 cursor-pointer transition">
                <a class="inline-block text-center bg-red-500 text-white rounded px-4 py-2 hover:bg-red-600 w-full" href="index.php">Cancel</a>
            </div>
        </form>
    </div>

    <script src="scripts/convert.js"></script>
</body>

</html>
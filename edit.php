<?php
include 'koneksi.php';

$id = $_GET['id'];
$sql = "SELECT id, nama_barang, jumlah, harga FROM barang WHERE id=$id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "No data found";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_barang = $_POST['nama_barang'];
    $jumlah = $_POST['jumlah'];

    // Menghapus simbol 'Rp' dan titik dari harga
    $harga = str_replace(['Rp ', '.'], '', $_POST['harga']);

    $update_sql = "UPDATE barang SET nama_barang='$nama_barang', jumlah='$jumlah', harga='$harga' WHERE id=$id";

    if ($conn->query($update_sql) === TRUE) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="container bg-white p-6 rounded-lg shadow-md w-full max-w-md">
        <h1 class="text-2xl font-semibold mb-6 text-center text-gray-800">Edit Barang</h1>
        <form method="post" action="">
            <label for="nama_barang" class="block text-gray-700 font-bold mb-2">Nama Barang:</label>
            <input type="text" id="nama_barang" name="nama_barang" value="<?php echo $row['nama_barang']; ?>" class="border border-gray-300 rounded-lg p-2 w-full mb-4" required>

            <label for="jumlah" class="block text-gray-700 font-bold mb-2">Jumlah:</label>
            <input type="number" id="jumlah" name="jumlah" value="<?php echo $row['jumlah']; ?>" class="border border-gray-300 rounded-lg p-2 w-full mb-4" required>

            <label for="harga" class="block text-gray-700 font-bold mb-2">Harga:</label>
            <input type="text" id="harga" name="harga" value="Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?>" class="border border-gray-300 rounded-lg p-2 w-full mb-4" required>

            <input type="submit" value="Update" class="bg-blue-500 text-white rounded-lg px-4 py-2 hover:bg-blue-600 cursor-pointer transition">
            <a class="inline-block bg-gray-400 text-white rounded-lg px-4 py-2 mt-2 hover:bg-gray-500" href="index.php">Cancel</a>
        </form>
    </div>

    <script src="scripts/convert.js"></script>
</body>

</html>
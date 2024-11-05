<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_barang = $_POST['nama_barang'];
    $jumlah = $_POST['jumlah'];

    $harga = str_replace(['Rp ', '.'], '', $_POST['harga']);

    $insert_sql = "INSERT INTO barang (nama_barang, jumlah, harga) VALUES ('$nama_barang', '$jumlah', '$harga')";

    if ($conn->query($insert_sql) === TRUE) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error inserting record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Barang</title>
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
            <input type="text" id="harga" name="harga" class="border border-gray-300 rounded-lg p-2 w-full mb-4" required>

            <input type="submit" value="Add" class="bg-blue-500 text-white rounded-lg px-4 py-2 hover:bg-blue-600 cursor-pointer transition">
            <a class="inline-block bg-gray-400 text-white rounded-lg px-4 py-2 mt-2 hover:bg-gray-500" href="index.php">Cancel</a>
        </form>
    </div>

    <script>
        const hargaInput = document.getElementById('harga');

        function formatRupiah(angka, prefix = 'Rp ') {
            let number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix + rupiah;
        }

        hargaInput.addEventListener('keyup', function(e) {
            hargaInput.value = formatRupiah(this.value);
        });

        // Menghapus format saat form disubmit
        document.querySelector('form').addEventListener('submit', function() {
            hargaInput.value = hargaInput.value.replace(/Rp |\.|,/g, '');
        });
    </script>
</body>

</html>
<?php
include 'modules/auth/session.php';
include 'config/config.php';

function validate_and_import($file)
{
    global $conn;

    $allowed_headers = ['nama_barang', 'jumlah', 'harga'];
    $file_headers = [];
    $data = [];

    if (($handle = fopen($file, 'r')) !== FALSE) {
        $file_headers = fgetcsv($handle, 1000, ',');
        $file_headers = array_map('strtolower', array_map('trim', $file_headers));
        $file_headers = array_map(function ($header) {
            return trim($header, '"');
        }, $file_headers);

        // Remove the ID column from the headers
        if (isset($file_headers[0]) && $file_headers[0] === 'id') {
            array_shift($file_headers);
        }

        if ($file_headers !== $allowed_headers) {
            throw new Exception('Invalid format');
        }

        while (($row = fgetcsv($handle, 1000, ',')) !== FALSE) {
            $data[] = $row;
        }
        fclose($handle);
    } else {
        throw new Exception('Unable to open file');
    }

    $stmt = $conn->prepare("INSERT INTO barang (nama_barang, jumlah, harga) VALUES (?, ?, ?)");
    foreach ($data as $row) {
        // Remove the ID column from the data
        if (isset($row[0]) && is_numeric($row[0])) {
            array_shift($row);
        }

        // Skip rows that are empty or do not have enough columns
        if (count($row) < 3 || empty($row[0]) || empty($row[1]) || empty($row[2])) {
            continue; // Skip to the next row
        }

        $nama_barang = htmlspecialchars(strip_tags(trim($row[0])));
        $jumlah = filter_var($row[1], FILTER_VALIDATE_INT);
        $harga = filter_var($row[2], FILTER_VALIDATE_FLOAT);

        if ($nama_barang && $jumlah !== false && $harga !== false) {
            $stmt->bind_param("sid", $nama_barang, $jumlah, $harga);
            $stmt->execute();
        } else {
            throw new Exception('Invalid data in file');
        }
    }


    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['file'])) {
    try {
        validate_and_import($_FILES['file']['tmp_name']);
        $redirect_url = isset($_POST['redirect_url']) ? $_POST['redirect_url'] : 'index.php';
        header("Location: " . $redirect_url);
        exit;
    } catch (Exception $e) {
        $error_message = $e->getMessage();
    }
}

$redirect_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'index.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import Barang</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="container bg-white p-6 rounded-lg shadow-md w-full max-w-md">
        <h1 class="text-2xl font-semibold mb-6 text-center text-gray-800">Import Barang</h1>
        <?php if (isset($error_message)): ?>
            <p class="text-red-500 text-center mb-4"><?php echo htmlspecialchars($error_message); ?></p>
        <?php endif; ?>
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="redirect_url" value="<?php echo htmlspecialchars($redirect_url); ?>">
            <label for="file" class="block text-gray-700 font-bold mb-2">Select file:</label>
            <input type="file" id="file" name="file" accept=".csv" class="border border-gray-300 rounded-lg p-2 w-full mb-4" required>
            <p class="text-sm text-gray-500">Only CSV files are allowed</p>

            <div class="flex gap-8 mt-5">
                <input type="submit" value="Import" class="bg-green-500 text-white rounded px-4 py-2 w-full hover:bg-green-600 cursor-pointer transition">
                <a class="inline-block text-center bg-red-500 text-white rounded px-4 py-2 hover:bg-red-600 w-full transition" href="<?php echo htmlspecialchars($redirect_url); ?>">Cancel</a>
            </div>
        </form>
    </div>
</body>

</html>
<?php
include 'koneksi.php';

$search = isset($_GET['search']) ? $_GET['search'] : '';

$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$total_sql = "SELECT COUNT(*) as total FROM barang WHERE nama_barang LIKE '%$search%'";
$total_result = $conn->query($total_sql);
$total_row = $total_result->fetch_assoc();
$total_records = $total_row['total'];
$total_pages = ceil($total_records / $limit);

$sql = "SELECT id, nama_barang, jumlah, harga FROM barang WHERE nama_barang LIKE '%$search%' LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .column-id {
            width: 50px;
        }
        .column-nama {
            width: 200px;
        }
        .column-jumlah {
            width: 100px;
        }
        .column-harga {
            width: 150px;
        }
        .column-action {
            width: 150px;
        }
        input[type="number"] {
            -moz-appearance: textfield;
        }

        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans">
    <div class="container mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-5xl mb-3 font-semibold text-center text-green-500">Data Barang</h1>
        
        <!-- Search Form -->
        <form method="GET" class="mb-5 w-10 flex">
            <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Search..." class="border rounded-l py-2 px-4 flex-1">
            <button type="submit" class="bg-green-500 text-white rounded-r px-4 py-2 hover:opacity-80 transition">Search</button>
        </form>

        <table class="min-w-full mt-5 border-collapse">
            <thead class="bg-green-500 text-white">
                <tr>
                    <th class="py-3 px-4 column-id text-left">ID</th>
                    <th class="py-3 px-4 column-nama text-left">Nama Barang</th>
                    <th class="py-3 px-4 column-jumlah text-left">Jumlah</th>
                    <th class="py-3 px-4 column-harga text-left">Harga</th>
                    <th class="py-3 px-4 column-action text-left">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    $counter = 0;
                    while($row = $result->fetch_assoc()) {
                        $rowClass = $counter % 2 === 0 ? 'bg-white' : 'bg-gray-100';
                        echo "<tr class='$rowClass hover:bg-gray-200'>
                                <td class='py-2 px-4 column-id'>" . $row["id"]. "</td>
                                <td class='py-2 px-4 column-nama'>" . $row["nama_barang"]. "</td>
                                <td class='py-2 px-4 column-jumlah'>" . $row["jumlah"]. "</td>
                                <td class='py-2 px-4 column-harga'>Rp " . number_format($row["harga"], 0, ',', '.'). "</td>
                                <td class='py-2 px-4 column-action'>
                                    <a class='inline-block bg-green-500 text-white rounded px-3 py-1 hover:opacity-80 transition' href='edit.php?id=" . $row["id"] . "'>Edit</a>
                                    <a class='inline-block bg-red-500 text-white rounded px-3 py-1 hover:opacity-80 transition' href='delete.php?id=" . $row["id"] . "' onclick='return confirm(\"Are you sure you want to delete this item?\")'>Delete</a>
                                </td>
                              </tr>";
                        $counter++;
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center py-4'>No data found</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
        <div class="mt-5 flex items-center justify-between">
    <span class="text-gray-700">Showing page <?php echo $page; ?> of <?php echo $total_pages; ?></span>
    
    <div class="flex items-center space-x-2">
        <?php if ($page > 1): ?>
            <a href="?search=<?php echo htmlspecialchars($search); ?>&page=<?php echo $page - 1; ?>" class="px-3 py-2 text-white bg-green-500 rounded hover:bg-green-400 w-24 text-center transition">Previous</a>
        <?php endif; ?>
        
        <form method="GET" class="flex items-center space-x-1">
            <input type="number" name="page" value="<?php echo $page; ?>" min="1" max="<?php echo $total_pages; ?>" class="border rounded py-2 px-3 w-16 text-center" required>
            <input type="hidden" name="search" value="<?php echo htmlspecialchars($search); ?>">
        </form>
        
        <?php if ($page < $total_pages): ?>
            <a href="?search=<?php echo htmlspecialchars($search); ?>&page=<?php echo $page + 1; ?>" class="px-3 py-2 text-white bg-green-500 rounded hover:bg-green-400 w-24 text-center transition">Next</a>
        <?php endif; ?>
    </div>
</div>

    </div>
</body>
<footer>
    <div class="container mx-auto mt-2 p-6">
        <p class="text-center text-gray-500">Native <span class="line-through">C</span>RUD App Without Bootstrap</p>
        <p class="text-center text-gray-500">Made with ❤️ by <a class="font-bold" href="https://github.com/KidiXDev" target="_blank">KidiXDev</a></p>
    </div>
</footer>
</html>




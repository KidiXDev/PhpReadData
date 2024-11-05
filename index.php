<?php
include 'session.php';
include 'koneksi.php';

$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'asc';
$filter_by = isset($_GET['filter_by']) ? $_GET['filter_by'] : 'nama_barang';

$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$total_sql = "SELECT COUNT(*) as total FROM barang WHERE $filter_by LIKE ?";
$stmt = $conn->prepare($total_sql);
$search_param = "%$search%";
$stmt->bind_param("s", $search_param);
$stmt->execute();
$total_result = $stmt->get_result();
$total_row = $total_result->fetch_assoc();
$total_records = $total_row['total'];
$total_pages = ceil($total_records / $limit);
$stmt->close();

$order_by = $sort === 'desc' ? 'DESC' : 'ASC';
$sql = "SELECT id, nama_barang, jumlah, harga FROM barang WHERE $filter_by LIKE ? ORDER BY $filter_by $order_by LIMIT ? OFFSET ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sii", $search_param, $limit, $offset);
$stmt->execute();
$result = $stmt->get_result();
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="index.css">
</head>

<body class="bg-gray-100 font-sans">
    <!-- buy me a coffee widget, comment or remove this code to hide it -->
    <script data-name="BMC-Widget" data-cfasync="false" src="https://cdnjs.buymeacoffee.com/1.0.0/widget.prod.min.js" data-id="kidixdev" data-description="Support me on Buy me a coffee!" data-message="" data-color="#40DCA5" data-position="Right" data-x_margin="18" data-y_margin="18"></script>

    <div class="container mx-auto mt-10 p-6 bg-white rounded-lg shadow-md flex justify-between">
        <h1 class="text-2xl text-green-600 font-semibold">
            <i class="fa-solid fa-database"></i> Data Barang
        </h1>

        <div class="flex items-center space-x-4">
            <div class="relative">
                <button class="flex items-center space-x-2 focus:outline-none" onclick="toggleDropdown()">
                    <i class="fa-solid fa-user text-green-600"></i>
                    <span class="text-green-600 font-semibold"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                    <i class="fa-solid fa-caret-down text-green-600"></i>
                </button>

                <!-- Dropdown menu -->
                <div id="dropdownMenu" class="absolute font-semibold right-0 mt-2 w-40 bg-white border rounded-lg shadow-lg hidden">
                    <a href="logout.php" class="block px-4 py-2 text-gray-800 hover:bg-gray-100"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById("dropdownMenu");
            dropdown.classList.toggle("hidden");
        }

        window.addEventListener("click", function(event) {
            const dropdown = document.getElementById("dropdownMenu");
            if (!event.target.closest(".relative")) {
                dropdown.classList.add("hidden");
            }
        });
    </script>



    <div class="container mx-auto mt-5 p-6 bg-white rounded-lg shadow-md">
        <div class="flex justify-between mb-5">
            <div class="flex gap-2">
                <!-- Search Form -->
                <form method="GET" class="flex">
                    <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Search" class="border rounded-l py-2 px-4 flex-1">
                    <button type="submit" class="bg-green-500 text-white rounded-r px-4 py-2 hover:opacity-80 transition"><i class="fa-solid fa-magnifying-glass"></i> </button>
                </form>

                <!-- Filter Form -->
                <form method="GET" class="flex items-center space-x-2">
                    <input type="hidden" name="search" value="<?php echo htmlspecialchars($search); ?>">
                    <select name="filter_by" class="border rounded py-2 px-4">
                        <option value="nama_barang" <?php echo $filter_by === 'nama_barang' ? 'selected' : ''; ?>>Nama Barang</option>
                        <option value="id" <?php echo $filter_by === 'id' ? 'selected' : ''; ?>>ID</option>
                        <option value="jumlah" <?php echo $filter_by === 'jumlah' ? 'selected' : ''; ?>>Jumlah</option>
                        <option value="harga" <?php echo $filter_by === 'harga' ? 'selected' : ''; ?>>Harga</option>
                    </select>
                    <select name="sort" class="border rounded py-2 px-4">
                        <option value="asc" <?php echo $sort === 'asc' ? 'selected' : ''; ?>>Ascending</option>
                        <option value="desc" <?php echo $sort === 'desc' ? 'selected' : ''; ?>>Descending</option>
                    </select>
                    <button type="submit" class="bg-green-500 text-white rounded px-4 py-2 hover:opacity-80 transition"><i class="fa-solid fa-filter"></i></button>
                </form>
            </div>

            <div class="flex gap-3">
                <a class='inline-block text-center content-center bg-green-500 text-white rounded px-4 py-1 hover:opacity-80 transition' href='add.php'><i class="fa-solid fa-plus"></i></a>
            </div>
        </div>

        <table class="min-w-full mt-5 border-collapse">
            <thead class="bg-green-500 text-white">
                <tr>
                    <th class="py-3 px-4 column-id text-left">ID</th>
                    <th class="py-3 px-4 column-nama text-left">Nama Barang</th>
                    <th class="py-3 px-4 column-jumlah text-left">Jumlah</th>
                    <th class="py-3 px-4 column-harga text-left">Harga</th>
                    <th class="py-3 px-4 column-action text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    $counter = 0;
                    while ($row = $result->fetch_assoc()) {
                        $rowClass = $counter % 2 === 0 ? 'bg-white' : 'bg-gray-100';
                        echo "<tr class='$rowClass hover:bg-gray-200'>
                                <td class='py-2 px-4 '>" . $row["id"] . "</td>
                                <td class='py-2 px-4'>" . $row["nama_barang"] . "</td>
                                <td class='py-2 px-4'>" . $row["jumlah"] . "</td>
                                <td class='py-2 px-4'>Rp " . number_format($row["harga"], 0, ',', '.') . "</td>
                                <td class='py-2 px-4 text-center'>
                                    <a class='inline-block bg-green-500 text-white rounded px-3 py-1 hover:opacity-80 transition' href='edit.php?id=" . $row["id"] . "'><i class='fa-solid fa-pen-to-square'></i></a>
                                    <a class='inline-block bg-red-500 text-white rounded px-3 py-1 hover:opacity-80 transition' href='delete.php?id=" . $row["id"] . "&search=" . htmlspecialchars($search) . "&page=" . $page . "' onclick='return confirm(\"Are you sure you want to delete this item?\")'><i class='fa-solid fa-trash'></i></a>
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
                <!-- prev -->
                <?php if ($page > 1): ?>
                    <a href="?search=<?php echo htmlspecialchars($search); ?>&page=<?php echo $page - 1; ?>&sort=<?php echo $sort; ?>&filter_by=<?php echo $filter_by; ?>" class="px-5 py-2 text-white bg-green-500 rounded hover:bg-green-400 text-center transition"><i class="fa-solid fa-backward"></i></a>
                <?php endif; ?>

                <form method="GET" class="flex items-center space-x-1">
                    <input type="number" name="page" value="<?php echo $page; ?>" min="1" max="<?php echo $total_pages; ?>" class="border rounded py-2 px-3 w-16 text-center" required>
                    <input type="hidden" name="search" value="<?php echo htmlspecialchars($search); ?>">
                    <input type="hidden" name="sort" value="<?php echo htmlspecialchars($sort); ?>">
                    <input type="hidden" name="filter_by" value="<?php echo htmlspecialchars($filter_by); ?>">
                </form>

                <!-- next -->
                <?php if ($page < $total_pages): ?>
                    <a href="?search=<?php echo htmlspecialchars($search); ?>&page=<?php echo $page + 1; ?>&sort=<?php echo $sort; ?>&filter_by=<?php echo $filter_by; ?>" class="px-5 py-2 text-white bg-green-500 rounded hover:bg-green-400 text-center transition"><i class="fa-solid fa-forward"></i></a>
                <?php endif; ?>
            </div>
        </div>

    </div>
</body>
<footer>
    <div class="container mx-auto mt-2 p-6">
        <p class="text-center text-gray-500">Native CRUD App Without Bootstrap</p>
        <p class="text-center text-gray-500">Made with ❤️ by <a class="font-bold" href="https://github.com/KidiXDev" target="_blank">KidiXDev</a></p>
    </div>
</footer>

</html>
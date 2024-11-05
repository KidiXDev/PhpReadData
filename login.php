<?php
include 'koneksi.php';

session_start();

if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND password=?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;
        $_SESSION['login_time'] = time();
        session_regenerate_id(true);
        header("Location: index.php");
        exit;
    } else {
        $error = "Invalid username or password";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="wave.css">
</head>

<body>
    <div class="ocean">
        <div class="wave"></div>
        <div class="wave"></div>
        <div class="wave"></div>
    </div>
    <div class="bg-gray-100 flex items-center justify-center h-screen">
        <div class="container bg-white p-6 rounded-lg shadow-md w-full max-w-md">
            <h1 class="text-5xl mb-4 text-center text-gray-800 font-bold">Login</h1>

            <?php if (isset($error)): ?>
                <p class="text-red-500 text-center mb-4"><?php echo $error; ?></p>
            <?php endif; ?>

            <?php if (isset($_GET['error']) && $_GET['error'] == 'session_expired'): ?>
                <p class="text-red-500 text-center mb-4">Your session expired. Please log in again.</p>
            <?php endif; ?>

            <form class="mt-12" method="post" action="">
                <div class="flex flex-col">
                    <label for="username" class="block text-gray-700 font-bold mb-2">Username:</label>
                    <input type="text" id="username" name="username" class="border border-gray-300 rounded-lg p-2 w-full mb-4" required>

                    <label for="password" class="block text-gray-700 font-bold mb-2">Password:</label>
                    <input type="password" id="password" name="password" class="border border-gray-300 rounded-lg p-2 w-full mb-4" required>
                </div>

                <div class="flex justify-center mt-5">
                    <input type="submit" value="Login" class="font-bold bg-blue-500 w-full text-white rounded-lg px-4 py-2 hover:bg-blue-600 cursor-pointer transition">
                </div>
            </form>
        </div>
    </div>
</body>

</html>
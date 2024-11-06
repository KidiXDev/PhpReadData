<?php
include 'config/config.php';

session_start();

if (isset($_SESSION['username'])) {
    header("Location: /");
    exit;
}

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$error = '';

if (isset($_GET['error']) && $_GET['error'] == 'session_expired') {
    $error = "Your session expired. Please log in again.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $error = "CSRF token validation failed.";
    } else {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            if (password_verify($password, $row['password'])) {
                $user_id = $row['id'];

                // Check if there is an active session for this user
                $stmt = $conn->prepare("SELECT * FROM sessions WHERE user_id=? AND expires_at > NOW()");
                $stmt->bind_param("i", $user_id);
                $stmt->execute();
                $active_session_result = $stmt->get_result();

                if ($active_session_result->num_rows > 0) {
                    $error = "There is already an active session for this account.";
                } else {
                    $_SESSION['username'] = $username;
                    $_SESSION['login_time'] = time();
                    session_regenerate_id(true);

                    $session_id = session_id();
                    $expires_at = date('Y-m-d H:i:s', time() + 1800);

                    $stmt = $conn->prepare("INSERT INTO sessions (user_id, session_id, expires_at) VALUES (?, ?, ?)");
                    $stmt->bind_param("iss", $user_id, $session_id, $expires_at);
                    $stmt->execute();
                    $stmt->close();

                    header("Location: /");
                    exit;
                }
            } else {
                $error = "Invalid login credentials.";
            }
        } else {
            $error = "Invalid login credentials.";
        }

        $stmt->close();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/wave.css">
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

            <?php if (!empty($error)): ?>
                <p class="text-red-500 text-center mb-4"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
            <?php endif; ?>

            <form class="mt-12" method="post" action="">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

                <div class="flex flex-col">
                    <label for="username" class="block text-gray-700 font-bold mb-2">Username:</label>
                    <input type="text" id="username" name="username" class="border border-gray-300 rounded p-2 w-full mb-4" required>

                    <label for="password" class="block text-gray-700 font-bold mb-2">Password:</label>
                    <input type="password" id="password" name="password" class="border border-gray-300 rounded   p-2 w-full mb-4" required>
                </div>

                <div class="flex justify-center mt-5">
                    <input type="submit" value="Login" class="font-bold bg-blue-500 w-full text-white rounded px-4 py-2 hover:bg-blue-600 cursor-pointer transition">
                </div>
            </form>
        </div>
    </div>
</body>

</html>
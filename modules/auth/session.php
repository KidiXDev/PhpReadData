<?php
session_start();
include 'config/config.php';

$timeout_duration = 1800;

if (!isset($_SESSION['username'])) {
    header("Location: auth/login");
    exit;
}

if (isset($_SESSION['login_time']) && (time() - $_SESSION['login_time']) > $timeout_duration) {
    $session_id = session_id();
    $stmt = $conn->prepare("DELETE FROM sessions WHERE session_id = ?");
    $stmt->bind_param("s", $session_id);
    $stmt->execute();
    $stmt->close();

    session_unset();
    session_destroy();
    header("Location: auth/login?error=session_expired");
    exit;
} else {
    $_SESSION['login_time'] = time();
    $expires_at = date('Y-m-d H:i:s', time() + $timeout_duration);
    $session_id = session_id();
    $stmt = $conn->prepare("UPDATE sessions SET expires_at = ? WHERE session_id = ?");
    $stmt->bind_param("ss", $expires_at, $session_id);
    $stmt->execute();
    $stmt->close();
}

if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

<?php
session_start();

$timeout_duration = 1800;

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

if (isset($_SESSION['login_time']) && (time() - $_SESSION['login_time']) > $timeout_duration) {
    session_unset();
    session_destroy();
    header("Location: login.php?error=session_expired");
    exit;
} else {
    $_SESSION['login_time'] = time();
}

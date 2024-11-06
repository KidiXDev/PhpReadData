<?php
session_start();
include 'config/config.php';

$session_id = session_id();
$stmt = $conn->prepare("DELETE FROM sessions WHERE session_id = ?");
$stmt->bind_param("s", $session_id);
$stmt->execute();
$stmt->close();

session_unset();
session_destroy();
header("Location: /auth/login");
exit;

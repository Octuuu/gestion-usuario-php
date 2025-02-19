<?php
include '../includes/header.php';
require_once '../config/database.php';

if (!isset($_SESSION["user_id"]) || $_SESSION["user_role"] !== 'admin') {
    header("Location: login.php");
    exit();
}

if (isset($_GET["id"])) {
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$_GET["id"]]);
    header("Location: admin.php?success=deleted");
    exit();
} else {
    header("Location: admin.php");
    exit();
}
?>

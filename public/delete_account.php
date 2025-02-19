<?php
include '../includes/header.php';
require_once '../config/database.php';

if (!isset($_SESSION["user_id"])) {
    header("location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$user_id]);

    session_destroy();
    header("Location: login.php?account_deleted=1");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Cuenta</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body class="bg-gray-900 text-white">

<div class="container mx-auto p-6">
    <div class="bg-gray-800 p-8 rounded-lg shadow-lg">
        <h1 class="text-3xl font-semibold mb-4 text-teal-400">Eliminar Cuenta</h1>

        <p class="text-lg mb-4">¿Estás seguro de que deseas eliminar tu cuenta permanentemente? Esta acción no se puede deshacer.</p>

        <form method="POST">
            <button type="submit" class="px-4 py-2 bg-red-500 rounded hover:bg-red-600">Eliminar Cuenta</button>
        </form>

        <a href="profile.php" class="px-4 py-2 bg-gray-500 rounded hover:bg-gray-600 mt-4 inline-block">Cancelar</a>
    </div>
</div>

</body>
</html>

<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="../public/css/styles.css">
</head>
<body class="bg-gray-900 text-white">
    <nav class="bg-gray-800 p-4 shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <a href="index.php" class="text-xl font-bold text-teal-400">User Management</a>
            <div>
                <?php if (isset($_SESSION["user_id"])): ?>
                    <a href="profile.php" class="px-4 py-2 bg-teal-500 rounded hover:bg-teal-600">Perfil</a>
                    <a href="logout.php" class="px-4 py-2 bg-red-500 rounded hover:bg-red-600">Cerrar Sesión</a>
                <?php else: ?>
                    <a href="login.php" class="px-4 py-2 bg-teal-500 rounded hover:bg-teal-600">Iniciar Sesión</a>
                    <a href="register.php" class="px-4 py-2 bg-teal-500 rounded hover:bg-teal-600">Registrarse</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    

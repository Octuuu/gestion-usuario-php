<?php 
include '../includes/header.php';
require_once '../config/database.php';

// Verifica que el usuario esté logueado
if (!isset($_SESSION["user_id"])) {
    header("location: login.php");
    exit();
}

$user_name = $_SESSION["user_name"];
$user_email = isset($_SESSION["user_email"]) ? $_SESSION["user_email"] : 'No disponible'; 
$user_role = isset($_SESSION["user_role"]) ? $_SESSION["user_role"] : 'No disponible';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body class="bg-gray-900 text-white">

    <div class="container mx-auto p-6">
        <div class="bg-gray-800 p-8 rounded-lg shadow-lg">
            <h1 class="text-3xl font-semibold mb-4 text-teal-400">Bienvenido, <?php echo htmlspecialchars($user_name); ?>!</h1>

            <div class="mb-4">
                <p class="text-lg">Correo electrónico: <span class="font-semibold"><?php echo htmlspecialchars($user_email); ?></span></p>
                <p class="text-lg">Rol: <span class="font-semibold"><?php echo ucfirst($user_role); ?></span></p>
            </div>

            <div class="mt-6 mb-6">
                <h2 class="text-2xl font-semibold text-teal-300 mb-2">Información Adicional</h2>
                <p class="text-sm">Aquí podrás encontrar más detalles sobre tu cuenta y realizar algunas acciones.</p>
            </div>

            <div class="mt-6">
                <a href="edit_profile.php" class="px-4 py-2 bg-teal-500 rounded hover:bg-teal-600 mb-3 inline-block">Editar Perfil</a>
                <a href="change_password.php" class="px-4 py-2 bg-blue-500 rounded hover:bg-blue-600 mb-3 inline-block">Cambiar Contraseña</a>
                <a href="delete_account.php" class="px-4 py-2 bg-red-500 rounded hover:bg-red-600 inline-block">Eliminar Cuenta</a>
            </div>

        </div>
    </div>

</body>
</html>

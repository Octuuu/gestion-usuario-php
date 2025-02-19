<?php 
include '../includes/header.php';
require_once '../config/database.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // Verificar si el correo ya está registrado
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
        echo "<p class='text-red-500 text-center'>El correo electrónico ya está registrado. Por favor, usa otro.</p>";
    } else {
        // Si el correo no existe, insertar el nuevo usuario
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        if ($stmt->execute([$name, $email, $password])) {
            header("location: login.php?success=registered");
            exit();
        } else {
            echo "<p class='text-red-500 text-center'>Error al registrar usuario. Intenta nuevamente.</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body class="bg-gray-900 text-white flex items-center justify-center h-screen">
    <form action="" method="POST" class="bg-gray-800 p-8 rounded-lg shadow-lg w-96">
        <h2 class="text-2xl font-bold mb-4 text-teal-400">Registro</h2>
        <input type="text" name="name" placeholder="Nombre" required class="w-full p-2 mb-3 rounded bg-gray-700 text-white">
        <input type="email" name="email" placeholder="Correo" required class="w-full p-2 mb-3 rounded bg-gray-700 text-white">
        <input type="password" name="password" placeholder="Contraseña" required class="w-full p-2 mb-3 rounded bg-gray-700 text-white">
        <button type="submit" class="w-full bg-teal-500 p-2 rounded hover:bg-teal-600">Registrarse</button>
        <p class="text-sm mt-3 text-center"><a href="login.php" class="text-teal-400">Ya tienes cuenta? Inicia sesión</a></p>
    </form>
</body>
</html>

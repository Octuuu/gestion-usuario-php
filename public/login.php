<?php 
include '../includes/header.php';
require_once '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["user_name"] = $user["name"];
        $_SESSION["user_role"] = $user["role"];

        header("Location: profile.php");
        exit();
    } else {
        $error = "Datos incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Login</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body class="bg-gray-900 text-white flex items-center justify-center h-screen">
    <form action="" method="POST" class="bg-gray-800 p-8 rounded-lg shadow-lg w-96">
        <h2 class="text-2xl font-bold mb-4 text-teal-400">Iniciar Sesión</h2>
        <input type="email" name="email" placeholder="Correo" required class="w-full p-2 mb-3 rounded bg-gray-700 text-white">
        <input type="password" name="password" placeholder="Contraseña" required class="w-full p-2 mb-3 rounded bg-gray-700 text-white">
        <button type="submit" class="w-full bg-teal-500 p-2 rounded hover:bg-teal-600">Iniciar Sesión</button>
        <p class="text-sm mt-3 text-center"><a href="register.php" class="text-teal-400">No tienes cuenta? Regístrate</a></p>
    </form>
</body>
</html>

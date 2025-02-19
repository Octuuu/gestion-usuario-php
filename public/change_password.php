<?php
include '../includes/header.php';
require_once '../config/database.php';

if (!isset($_SESSION["user_id"])) {
    header("location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if (!empty($current_password) && !empty($new_password) && !empty($confirm_password)) {
        if ($new_password === $confirm_password) {
            
            $stmt = $pdo->prepare("SELECT password FROM users WHERE id = ?");
            $stmt->execute([$user_id]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (password_verify($current_password, $user['password'])) {
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
                $stmt->execute([$hashed_password, $user_id]);

                header("Location: profile.php?success=password_updated");
                exit();
            } else {
                $error = "La contraseña actual no es correcta.";
            }
        } else {
            $error = "Las nuevas contraseñas no coinciden.";
        }
    } else {
        $error = "Por favor complete todos los campos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body class="bg-gray-900 text-white">

<div class="container mx-auto p-6">
    <div class="bg-gray-800 p-8 rounded-lg shadow-lg">
        <h1 class="text-3xl font-semibold mb-4 text-teal-400">Cambiar Contraseña</h1>

        <?php if (isset($error)): ?>
            <p class="text-red-500"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-4">
                <label for="current_password" class="block text-lg">Contraseña actual</label>
                <input type="password" id="current_password" name="current_password" class="w-full p-2 bg-gray-700 text-white rounded">
            </div>

            <div class="mb-4">
                <label for="new_password" class="block text-lg">Nueva contraseña</label>
                <input type="password" id="new_password" name="new_password" class="w-full p-2 bg-gray-700 text-white rounded">
            </div>

            <div class="mb-4">
                <label for="confirm_password" class="block text-lg">Confirmar nueva contraseña</label>
                <input type="password" id="confirm_password" name="confirm_password" class="w-full p-2 bg-gray-700 text-white rounded">
            </div>

            <button type="submit" class="px-4 py-2 bg-teal-500 rounded hover:bg-teal-600">Cambiar Contraseña</button>
        </form>
    </div>
</div>

</body>
</html>

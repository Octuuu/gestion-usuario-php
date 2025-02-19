<?php
include '../includes/header.php';
require_once '../config/database.php';

if (!isset($_SESSION["user_id"])) {
    header("location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];
$user_name = $_SESSION["user_name"];
$user_email = $_SESSION["user_email"];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_name = trim($_POST['name']);
    $new_email = trim($_POST['email']);

    if (!empty($new_name) && !empty($new_email)) {
        $stmt = $pdo->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
        $stmt->execute([$new_name, $new_email, $user_id]);

        $_SESSION["user_name"] = $new_name;
        $_SESSION["user_email"] = $new_email;

        header("Location: profile.php?success=updated");
        exit();
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
    <title>Editar Perfil</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body class="bg-gray-900 text-white">

<div class="container mx-auto p-6">
    <div class="bg-gray-800 p-8 rounded-lg shadow-lg">
        <h1 class="text-3xl font-semibold mb-4 text-teal-400">Editar Perfil</h1>

        <?php if (isset($error)): ?>
            <p class="text-red-500"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-4">
                <label for="name" class="block text-lg">Nombre</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user_name); ?>" class="w-full p-2 bg-gray-700 text-white rounded">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-lg">Correo electrónico</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user_email); ?>" class="w-full p-2 bg-gray-700 text-white rounded">
            </div>

            <button type="submit" class="px-4 py-2 bg-teal-500 rounded hover:bg-teal-600">Actualizar Perfil</button>
        </form>
    </div>
</div>

</body>
</html>

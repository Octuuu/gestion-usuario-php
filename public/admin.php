<?php
require_once '../config/database.php';
include '../includes/header.php';

if (!isset($_SESSION["user_id"]) || $_SESSION["user_role"] !== 'admin') {
    header("Location: login.php");
    exit();
}

$stmt = $pdo->query("SELECT * FROM users");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mx-auto mt-10">
    <h2 class="text-3xl font-bold text-teal-400 mb-4">Panel de Administración</h2>
    <table class="w-full text-left bg-gray-800 shadow-lg">
        <thead class="bg-teal-600 text-white">
            <tr>
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Nombre</th>
                <th class="px-4 py-2">Correo</th>
                <th class="px-4 py-2">Rol</th>
                <th class="px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr class="border-b border-gray-700">
                    <td class="px-4 py-2"><?php echo $user['id']; ?></td>
                    <td class="px-4 py-2"><?php echo $user['name']; ?></td>
                    <td class="px-4 py-2"><?php echo $user['email']; ?></td>
                    <td class="px-4 py-2"><?php echo $user['role']; ?></td>
                    <td class="px-4 py-2">
                        <a href="delete_user.php?id=<?php echo $user['id']; ?>" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include '../includes/footer.php'; ?>

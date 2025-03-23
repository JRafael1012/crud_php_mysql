<?php
session_start();
include 'db.php';

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

// Obtener todos los usuarios
$result = $conn->query("SELECT * FROM usuarios");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>CRUD PHP</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <h2>Bienvenido, <?= htmlspecialchars($_SESSION['usuario']) ?> | 
        <a href="logout.php">Cerrar sesión</a>
    </h2>

    <h2>Lista de Usuarios</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Acciones</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['nombre']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td>
                <a href="editar.php?id=<?= intval($row['id']) ?>">Editar</a> |
                <a href="eliminar.php?id=<?= intval($row['id']) ?>" onclick="return confirm('¿Eliminar usuario?')">Eliminar</a>
            </td>
        </tr>
        <?php } ?>
    </table>

    <h2>Agregar Usuario</h2>
    <form action="agregar.php" method="POST">
        <input type="text" name="nombre" placeholder="Nombre" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="contraseña" placeholder="Contraseña" required>
        <button type="submit">Agregar</button>
    </form>

</body>
</html>

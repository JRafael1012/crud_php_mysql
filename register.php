<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $correo = $conn->real_escape_string($_POST['correo']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO usuarios (nombre, correo, password, rol) VALUES (?, ?, ?, ?)");
    $rol = "usuario"; // Todos los nuevos usuarios son 'usuario' por defecto
    $stmt->bind_param("ssss", $nombre, $correo, $password, $rol);

    if ($stmt->execute()) {
        echo "✅ Registro exitoso. <a href='login.php'>Iniciar sesión</a>";
    } else {
        echo "❌ Error al registrar usuario.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Crear Cuenta</h2>
    <form action="register.php" method="POST">
        <input type="text" name="nombre" placeholder="Nombre" required>
        <input type="email" name="correo" placeholder="Correo" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <button type="submit">Registrarse</button>
    </form>
</body>
</html>

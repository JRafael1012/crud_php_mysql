<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $email = $conn->real_escape_string($_POST['email']);
    $contraseña = password_hash($_POST['contraseña'], PASSWORD_BCRYPT); // Encripta la contraseña

    $sql = "INSERT INTO usuarios (nombre, email, contraseña) VALUES ('$nombre', '$email', '$contraseña')";
    
    if ($conn->query($sql)) {
        header("Location: index.php?success=Usuario agregado con éxito");
    } else {
        header("Location: index.php?error=Error al agregar usuario");
    }
    exit();
}
?>

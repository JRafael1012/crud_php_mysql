<?php
include 'db.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php?error=ID inválido");
    exit();
}

$id = $conn->real_escape_string($_GET['id']);

// Verificar si el usuario existe antes de eliminar
$stmt = $conn->prepare("SELECT id FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: index.php?error=Usuario no encontrado");
    exit();
}

// Proceder con la eliminación
$stmt = $conn->prepare("DELETE FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: index.php?success=Usuario eliminado");
exit();
?>

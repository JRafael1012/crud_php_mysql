<?php
include 'db.php'; // Asegúrate de que este archivo existe y se conecta correctamente a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica que los datos no estén vacíos
    if (isset($_POST['id']) && isset($_POST['nombre'])) {
        $id = intval($_POST['id']); // Convierte a número entero para seguridad
        $nombre = $conn->real_escape_string($_POST['nombre']);

        // Asegura que el ID es válido
        if ($id > 0) {
            $sql = "UPDATE usuarios SET nombre='$nombre' WHERE id=$id";

            if ($conn->query($sql) === TRUE) {
                echo "Registro actualizado correctamente";
            } else {
                echo "Error al actualizar: " . $conn->error;
            }
        } else {
            echo "ID no válido";
        }
    } else {
        echo "Datos incompletos";
    }
} else {
    echo "Método no permitido";
}

$conn->close();
?>

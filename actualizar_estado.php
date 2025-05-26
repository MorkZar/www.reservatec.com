<?php
include 'conexionBD.php';

if (isset($_POST['id'], $_POST['estado'])) {
    $id = intval($_POST['id']);
    $estado = $_POST['estado'];

    $stmt = $conexion->prepare("UPDATE peticiones SET estado_peticion = ? WHERE id_peticion = ?");
    $stmt->bind_param('si', $estado, $id);

    if ($stmt->execute()) {
        echo "Estado actualizado a $estado.";
    } else {
        echo "Error al actualizar.";
    }

    $stmt->close();
} else {
    echo "Datos no válidos.";
}
?>

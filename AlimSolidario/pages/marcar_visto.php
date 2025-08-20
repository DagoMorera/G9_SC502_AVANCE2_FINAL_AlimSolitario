<?php
session_start();

// Verificar si el usuario está logueado y es beneficiario
if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] != 'beneficiario') {
    header("Location: login.php"); // Redirigir al login si no está logueado o no es beneficiario
    exit();
}

include('../config/db.php');

// Obtener el ID de la notificación
$notificacion_id = $_GET['id'];

// Marcar la notificación como vista
$sql = "UPDATE notificaciones SET visto = 1 WHERE id = '$notificacion_id'";

if ($conn->query($sql) === TRUE) {
    header("Location: dashboard.php"); // Redirigir al panel de usuario después de marcar la notificación como vista
} else {
    echo "Error al marcar la notificación como leída: " . $conn->error;
}
?>

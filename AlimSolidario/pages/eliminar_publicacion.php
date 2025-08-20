<?php
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php"); // Redirigir al login si no está logueado
    exit();
}

include('../config/db.php');

// Verificar si el parámetro 'id' está presente en la URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    // Verificar si la publicación pertenece al usuario logueado
    $sql_check = "SELECT * FROM publicaciones WHERE id = ? AND usuario_id = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("ii", $id, $_SESSION['usuario_id']);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        // Si la publicación existe y pertenece al usuario, la eliminamos
        $sql_delete = "DELETE FROM publicaciones WHERE id = ?";
        $stmt_delete = $conn->prepare($sql_delete);
        $stmt_delete->bind_param("i", $id);
        
        if ($stmt_delete->execute()) {
            // Redirigir al dashboard del donador si la publicación fue eliminada correctamente
            header("Location: dashboard_donador.php");
            exit();
        } else {
            echo "Error al eliminar la publicación.";
        }
    } else {
        echo "No se encontró la publicación o no tienes permisos para eliminarla.";
    }
} else {
    echo "No se ha especificado ninguna publicación para eliminar.";
}
?>

<?php
session_start();
session_destroy(); // Destruir todas las sesiones

// Redirigir al login después de cerrar sesión
header("Location: login.php");
exit();
?>

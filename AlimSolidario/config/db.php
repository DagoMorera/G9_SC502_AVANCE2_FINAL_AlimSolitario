<?php
$host = 'localhost';
$user = 'root';  // Usuario por defecto de XAMPP
$pass = '';      // Contraseña por defecto de XAMPP (vacío)
$dbname = 'alimsolidario'; // Nombre de la base de datos que vamos a crear

// Crear conexión
$conn = new mysqli($host, $user, $pass, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>

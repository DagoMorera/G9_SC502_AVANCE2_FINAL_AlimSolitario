<?php
// Iniciar sesión
session_start();

// Incluir el archivo de configuración para la conexión a la base de datos
include('../config/db.php');

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    // Sentencia preparada para prevenir inyecciones SQL
    $sql = "SELECT * FROM usuarios WHERE correo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $correo); // "s" significa string para el correo

    // Ejecutar la consulta
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
        // Verificar la contraseña
        if (password_verify($contraseña, $usuario['contraseña'])) {
            // Crear la sesión
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['nombre'] = $usuario['nombre']; // Guardamos el nombre
            $_SESSION['rol'] = $usuario['rol']; // Guardamos el rol

            // Redirigir al dashboard correspondiente según el rol
            if ($_SESSION['rol'] == 'donador') {
                header("Location: dashboard_donador.php"); // Redirigir al dashboard de donador
            } else {
                header("Location: dashboard.php"); // Redirigir al dashboard de beneficiario
            }
            exit(); // Evitar que siga ejecutando el código
        } else {
            $error = "Contraseña incorrecta.";
        }
    } else {
        $error = "El correo no está registrado.";
    }
}
?>

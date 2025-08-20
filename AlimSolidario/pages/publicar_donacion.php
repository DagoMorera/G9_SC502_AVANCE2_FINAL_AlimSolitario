<?php
session_start();

// Verificar si el usuario está logueado y es donador
if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] != 'donador') {
    header("Location: login.php"); // Redirigir al login si no está logueado o no es donador
    exit();
}

include('../config/db.php');

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $cantidad = $_POST['cantidad'];
    $estado = $_POST['estado'];
    $ubicacion = $_POST['ubicacion'];
    $fecha_expiracion = $_POST['fecha_expiracion'];
    $usuario_id = $_SESSION['usuario_id']; // ID del donador
    $provincia = $_POST['provincia']; // Obtener la provincia seleccionada
    $canton = $_POST['canton']; // Obtener el cantón
    $distrito = $_POST['distrito']; // Obtener el distrito

    // Validar datos (en este caso solo un chequeo básico)
    if (empty($nombre) || empty($cantidad) || empty($estado) || empty($ubicacion) || empty($fecha_expiracion)) {
        $error = "Todos los campos son obligatorios.";
    } else {
        // Insertar la donación en la base de datos
        $sql = "INSERT INTO donaciones (nombre, cantidad, estado, ubicacion, fecha_expiracion, usuario_id, provincia, canton, distrito) 
                VALUES ('$nombre', '$cantidad', '$estado', '$ubicacion', '$fecha_expiracion', '$usuario_id', '$provincia', '$canton', '$distrito')";

        if ($conn->query($sql) === TRUE) {
            $mensaje = "Donación publicada con éxito.";

            // Enviar notificaciones a los beneficiarios de la misma zona (provincia, cantón, distrito)
            $sql_beneficiarios = "SELECT id FROM usuarios WHERE rol = 'beneficiario' AND provincia = '$provincia' AND canton = '$canton' AND distrito = '$distrito'";
            $result_beneficiarios = $conn->query($sql_beneficiarios);

            if ($result_beneficiarios->num_rows > 0) {
                while ($beneficiario = $result_beneficiarios->fetch_assoc()) {
                    $usuario_id_beneficiario = $beneficiario['id'];
                    $mensaje_notificacion = "¡Nueva donación disponible en tu área! Alimento: $nombre, Cantidad: $cantidad, Estado: $estado";

                    // Insertar la notificación en la tabla de notificaciones
                    $sql_notificacion = "INSERT INTO notificaciones (usuario_id, mensaje) VALUES ('$usuario_id_beneficiario', '$mensaje_notificacion')";
                    $conn->query($sql_notificacion);
                }
            }
        } else {
            $error = "Error al publicar la donación: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicar Donación - AlimSolidario</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <header>
        <h1>Publicar Donación</h1>
    </header>
    <section>
        <form method="POST" action="publicar_donacion.php">
            <label for="nombre">Nombre del alimento:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="cantidad">Cantidad:</label>
            <input type="text" id="cantidad" name="cantidad" required>

            <label for="estado">Estado del alimento:</label>
            <select id="estado" name="estado" required>
                <option value="bueno">Bueno</option>
                <option value="cerca de expirar">Cerca de expirar</option>
                <option value="dañado">Dañado</option>
            </select>

            <label for="ubicacion">Ubicación:</label>
            <input type="text" id="ubicacion" name="ubicacion" required>

            <label for="fecha_expiracion">Fecha de expiración:</label>
            <input type="date" id="fecha_expiracion" name="fecha_expiracion" required>

            <!-- Selección de provincia, cantón y distrito -->
            <label for="provincia">Provincia:</label>
            <select id="provincia" name="provincia" required>
                <option value="San José">San José</option>
                <option value="Alajuela">Alajuela</option>
                <option value="Cartago">Cartago</option>
                <!-- Agregar más provincias según sea necesario -->
            </select>

            <label for="canton">Cantón:</label>
            <select id="canton" name="canton" required>
                <option value="Central">Central</option>
                <option value="Escazú">Escazú</option>
                <option value="Desamparados">Desamparados</option>
                <!-- Agregar más cantones según sea necesario -->
            </select>

            <label for="distrito">Distrito:</label>
            <select id="distrito" name="distrito" required>
                <option value="San José">San José</option>
                <option value="Santa Ana">Santa Ana</option>
                <option value="San Antonio">San Antonio</option>
                <!-- Agregar más distritos según sea necesario -->
            </select>

            <button type="submit">Publicar Donación</button>
        </form>

        <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
        <?php if (isset($mensaje)) { echo "<p style='color:green;'>$mensaje</p>"; } ?>
    </section>
</body>
</html>

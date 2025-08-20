<?php
session_start();

// Verificar si el usuario está logueado y es beneficiario
if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] != 'beneficiario') {
    header("Location: login.php"); // Redirigir al login si no está logueado o no es beneficiario
    exit();
}

include('../config/db.php');

// Obtener los datos del formulario (si se ha enviado)
$provincia = isset($_POST['provincia']) ? $_POST['provincia'] : '';
$canton = isset($_POST['canton']) ? $_POST['canton'] : '';
$distrito = isset($_POST['distrito']) ? $_POST['distrito'] : '';

// Consulta de donaciones filtradas por provincia, cantón y distrito
$sql = "SELECT * FROM donaciones WHERE (estado = 'bueno' OR estado = 'cerca de expirar')";

if ($provincia) {
    $sql .= " AND provincia = '$provincia'";
}
if ($canton) {
    $sql .= " AND canton = '$canton'";
}
if ($distrito) {
    $sql .= " AND distrito = '$distrito'";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Donaciones - AlimSolidario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header class="bg-primary text-white p-4">
        <div class="container">
            <h1>Donaciones Disponibles</h1>
        </div>
    </header>

    <div class="container mt-4">
        <!-- Formulario de Filtro -->
        <h2 class="mb-4">Filtrar por ubicación</h2>
        <form method="POST" action="ver_donaciones.php" class="row g-3">
            <div class="col-md-4">
                <label for="provincia" class="form-label">Provincia:</label>
                <select id="provincia" name="provincia" class="form-select">
                    <option value="">Seleccione una provincia</option>
                    <option value="San José" <?php if ($provincia == 'San José') echo 'selected'; ?>>San José</option>
                    <option value="Alajuela" <?php if ($provincia == 'Alajuela') echo 'selected'; ?>>Alajuela</option>
                    <option value="Cartago" <?php if ($provincia == 'Cartago') echo 'selected'; ?>>Cartago</option>
                </select>
            </div>

            <div class="col-md-4">
                <label for="canton" class="form-label">Cantón:</label>
                <select id="canton" name="canton" class="form-select">
                    <option value="">Seleccione un cantón</option>
                    <option value="Central" <?php if ($canton == 'Central') echo 'selected'; ?>>Central</option>
                    <option value="Escazú" <?php if ($canton == 'Escazú') echo 'selected'; ?>>Escazú</option>
                    <option value="Desamparados" <?php if ($canton == 'Desamparados') echo 'selected'; ?>>Desamparados</option>
                </select>
            </div>

            <div class="col-md-4">
                <label for="distrito" class="form-label">Distrito:</label>
                <select id="distrito" name="distrito" class="form-select">
                    <option value="">Seleccione un distrito</option>
                    <option value="San José" <?php if ($distrito == 'San José') echo 'selected'; ?>>San José</option>
                    <option value="Santa Ana" <?php if ($distrito == 'Santa Ana') echo 'selected'; ?>>Santa Ana</option>
                    <option value="San Antonio" <?php if ($distrito == 'San Antonio') echo 'selected'; ?>>San Antonio</option>
                </select>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary w-100">Filtrar</button>
            </div>
        </form>

        <h2 class="mt-5">Donaciones Disponibles</h2>

        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='card mb-3'>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>" . $row['nombre'] . "</h5>";
                echo "<p><strong>Cantidad:</strong> " . $row['cantidad'] . "</p>";
                echo "<p><strong>Estado:</strong> " . $row['estado'] . "</p>";
                echo "<p><strong>Ubicación:</strong> " . $row['ubicacion'] . "</p>";
                echo "<p><strong>Provincia:</strong> " . $row['provincia'] . "</p>";
                echo "<p><strong>Cantón:</strong> " . $row['canton'] . "</p>";
                echo "<p><strong>Distrito:</strong> " . $row['distrito'] . "</p>";
                echo "<p><strong>Fecha de Expiración:</strong> " . $row['fecha_expiracion'] . "</p>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<div class='alert alert-warning'>No hay donaciones disponibles en este momento.</div>";
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>

<?php
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php"); // Redirigir al login si no está logueado
    exit();
}

include('../config/db.php');

// Definir las variables por defecto
$titulo = $descripcion = $ubicacion = $categoria = $estado = $imagen = '';
$error = '';

// Comprobar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recoger los datos del formulario
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $ubicacion = $_POST['ubicacion'];
    $categoria = $_POST['categoria'];
    $estado = 'disponible'; // El estado por defecto será "disponible"
    $usuario_id = $_SESSION['usuario_id']; // Obtener el id del donador desde la sesión

    // Comprobar si todos los campos están completos
    if (!empty($titulo) && !empty($descripcion) && !empty($ubicacion) && !empty($categoria)) {
        // Subida de la imagen
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
            // Definir la carpeta donde se guardarán las imágenes
            $carpeta_imagenes = '../uploads/';  // Asegúrate de tener esta carpeta en tu servidor
            $nombre_imagen = $_FILES['imagen']['name'];
            $ruta_imagen = $carpeta_imagenes . $nombre_imagen;

            // Mover la imagen subida a la carpeta destino
            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_imagen)) {
                // Insertar la publicación en la base de datos
                $sql = "INSERT INTO publicaciones (titulo, descripcion, ubicacion, categoria, estado, imagen, usuario_id) 
                        VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssssssi", $titulo, $descripcion, $ubicacion, $categoria, $estado, $ruta_imagen, $usuario_id);

                if ($stmt->execute()) {
                    // Redirigir al dashboard del donador si la publicación fue insertada correctamente
                    header("Location: dashboard_donador.php");
                    exit();
                } else {
                    $error = "Hubo un error al agregar la publicación.";
                }
            } else {
                $error = "Error al subir la imagen.";
            }
        } else {
            $error = "Por favor, selecciona una imagen.";
        }
    } else {
        $error = "Todos los campos son obligatorios.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Publicación - AlimSolidario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilos generales (tomados del dashboard) */
        :root {
            --verde-oscuro: #1c2a18;
            --verde-medio: #03530dff;
            --verde-claro: #94DEA5;
            --acento: #ff9900;
        }

        body {
            font-family: 'Open Sans', sans-serif;
            background-color: var(--verde-oscuro);
            color: white;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: var(--verde-oscuro);
            color: white;
            padding: 2rem 0;
            text-align: center;
            font-family: 'Quicksand', sans-serif;
        }

        header h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .navbar-nav {
            display: flex;
            justify-content: center;
        }

        .navbar-nav li {
            list-style: none;
        }

        .container {
            padding: 2rem;
        }

        .form-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 2rem;
            background-color: #03530dff; /* Verde medio */
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .form-label {
            font-weight: bold;
        }

        .btn-primary {
            background-color: var(--verde-medio);
            border: none;
            padding: 12px 30px;
            border-radius: 5px;
            font-size: 1.1rem;
            font-weight: bold;
        }

        .btn-primary:hover {
            background-color: var(--verde-claro);
        }

        .alert-danger {
            font-size: 1.1rem;
        }

        footer {
            background-color: var(--verde-oscuro);
            color: white;
            padding: 1.5rem 0;
            text-align: center;
        }

        footer a {
            color: var(--acento);
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <!-- Barra de navegación (mismo diseño) -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">AlimSolidario</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard_donador.php">Dashboard Donador</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Cerrar sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <header>
        <h1>Agregar Nueva Publicación</h1>
        <p>Por favor llena el formulario para agregar una nueva donación.</p>
    </header>

    <!-- Formulario para agregar publicación -->
    <section class="container mt-4">
        <div class="form-container">
            <?php if (!empty($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
            <form method="POST" action="agregar_publicacion.php" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="titulo" class="form-label">Título del Producto:</label>
                    <input type="text" id="titulo" name="titulo" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción:</label>
                    <textarea id="descripcion" name="descripcion" class="form-control" rows="4" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="ubicacion" class="form-label">Ubicación:</label>
                    <input type="text" id="ubicacion" name="ubicacion" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="categoria" class="form-label">Categoría:</label>
                    <select class="form-select" id="categoria" name="categoria" required>
                        <option value="Grano">Grano</option>
                        <option value="Liquido">Liquido</option>
                        <option value="Lacteo">Lacteo</option>
                        <option value="Fruta">Frutas</option>
                        <option value="Verduras">Verduras</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="imagen" class="form-label">Imagen del Producto:</label>
                    <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Agregar Publicación</button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2025 AlimSolidario. Todos los derechos reservados.</p>
        </div>
    </footer>

</body>
</html>

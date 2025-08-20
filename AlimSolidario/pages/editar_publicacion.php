<?php
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php"); // Redirigir al login si no está logueado
    exit();
}

include('../config/db.php');

// Verificar si el parámetro 'id' está presente
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    // Obtener los datos actuales de la publicación
    $sql = "SELECT * FROM publicaciones WHERE id = ? AND usuario_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $id, $_SESSION['usuario_id']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $publicacion = $result->fetch_assoc();
    } else {
        header("Location: dashboard_donador.php"); // Redirigir si no se encuentra la publicación
        exit();
    }
} else {
    header("Location: dashboard_donador.php"); // Redirigir si no hay id
    exit();
}

// Definir las variables para el formulario
$titulo = $descripcion = $ubicacion = $categoria = $estado = $imagen_url = $error = '';

// Actualizar los datos si el formulario se ha enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recoger los datos del formulario
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $ubicacion = $_POST['ubicacion'];
    $categoria = $_POST['categoria'];
    $estado = $_POST['estado'];

    // Comprobar si se ha subido una nueva imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $directorio_destino = 'uploads/';
        $nombre_imagen = basename($_FILES['imagen']['name']);
        $ruta_imagen = $directorio_destino . $nombre_imagen;

        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_imagen)) {
            $imagen_url = $ruta_imagen;
        } else {
            $error = "Hubo un error al subir la imagen.";
        }
    } else {
        // Si no se ha subido una nueva imagen, mantener la imagen actual
        $imagen_url = $publicacion['imagen'];
    }

    // Comprobar si todos los campos están completos
    if (!empty($titulo) && !empty($descripcion) && !empty($ubicacion) && !empty($categoria)) {
        // Sentencia preparada para actualizar la publicación
        $sql_update = "UPDATE publicaciones SET titulo = ?, descripcion = ?, ubicacion = ?, categoria = ?, estado = ?, imagen = ? WHERE id = ? AND usuario_id = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("ssssssii", $titulo, $descripcion, $ubicacion, $categoria, $estado, $imagen_url, $id, $_SESSION['usuario_id']);

        if ($stmt_update->execute()) {
            // Redirigir al dashboard del donador si la publicación fue actualizada correctamente
            header("Location: dashboard_donador.php");
            exit();
        } else {
            $error = "Hubo un error al actualizar la publicación.";
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
    <title>Editar Publicación - AlimSolidario</title>
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
        <h1>Editar Publicación</h1>
        <p>Modifica los detalles de la publicación que deseas actualizar.</p>
    </header>

    <!-- Formulario para editar publicación -->
    <section class="container mt-4">
        <div class="form-container">
            <?php if (!empty($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
            <form method="POST" action="editar_publicacion.php?id=<?php echo $publicacion['id']; ?>" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="titulo" class="form-label">Título del Producto:</label>
                    <input type="text" id="titulo" name="titulo" class="form-control" value="<?php echo $publicacion['titulo']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción:</label>
                    <textarea id="descripcion" name="descripcion" class="form-control" rows="4" required><?php echo $publicacion['descripcion']; ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="ubicacion" class="form-label">Ubicación:</label>
                    <input type="text" id="ubicacion" name="ubicacion" class="form-control" value="<?php echo $publicacion['ubicacion']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="categoria" class="form-label">Categoría:</label>
                    <select class="form-select" id="categoria" name="categoria" required>
                        <option value="Grano" <?php echo ($publicacion['categoria'] == 'Grano') ? 'selected' : ''; ?>>Grano</option>
                        <option value="Liquido" <?php echo ($publicacion['categoria'] == 'Liquido') ? 'selected' : ''; ?>>Liquido</option>
                        <option value="Lacteo" <?php echo ($publicacion['categoria'] == 'Lacteo') ? 'selected' : ''; ?>>Lacteo</option>
                        <option value="Fruta" <?php echo ($publicacion['categoria'] == 'Fruta') ? 'selected' : ''; ?>>Frutas</option>
                        <option value="Verduras" <?php echo ($publicacion['categoria'] == 'Verduras') ? 'selected' : ''; ?>>Verduras</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="imagen" class="form-label">Imagen del Producto:</label>
                    <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
                    <small>Imagen actual: <img src="<?php echo $publicacion['imagen']; ?>" width="100"></small>
                </div>

                <div class="mb-3">
                    <label for="estado" class="form-label">Estado:</label>
                    <select class="form-select" id="estado" name="estado" required>
                        <option value="disponible" <?php echo ($publicacion['estado'] == 'disponible') ? 'selected' : ''; ?>>Disponible</option>
                        <option value="no_disponible" <?php echo ($publicacion['estado'] == 'no_disponible') ? 'selected' : ''; ?>>No disponible</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary w-100">Actualizar Publicación</button>
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

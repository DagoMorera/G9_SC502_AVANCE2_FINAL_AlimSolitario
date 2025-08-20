<?php
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php"); // Redirigir al login si no está logueado
    exit();
}

include('../config/db.php');
$filters = []; // Array para los filtros

// Si se ha seleccionado alguna categoría
if (isset($_GET['categoria']) && !empty($_GET['categoria'])) {
    $filters[] = "categoria = '" . $_GET['categoria'] . "'";
}

// Si se ha indicado alguna ubicación
if (isset($_GET['ubicacion']) && !empty($_GET['ubicacion'])) {
    $filters[] = "ubicacion LIKE '%" . $_GET['ubicacion'] . "%'"; // % para búsqueda parcial
}

// Si se ha seleccionado algún estado
if (isset($_GET['estado']) && !empty($_GET['estado'])) {
    $filters[] = "estado = '" . $_GET['estado'] . "'";
}

// Generamos la consulta con filtros si existen
$sql = "SELECT * FROM publicaciones"; // Iniciamos la consulta
if (count($filters) > 0) {
    $sql .= " WHERE " . implode(" AND ", $filters); // Añadimos los filtros si existen
}

$sql .= " ORDER BY fecha DESC"; // Ordenar por fecha

// Ejecutamos la consulta y guardamos el resultado en $result_publicaciones
$result_publicaciones = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - AlimSolidario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@700&family=Open+Sans:wght@400&display=swap" rel="stylesheet">
    <style>
        /* Colores similares al index y registro */
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

        nav {
            background-color: var(--verde-medio);
            padding: 1rem 0;
        }

        nav a {
            color: white;
            font-weight: bold;
            margin: 0 15px;
            font-size: 1.1rem;
            text-decoration: none;
        }

        nav a:hover {
            color: var(--acento);
        }

        .navbar-nav {
            display: flex;
            justify-content: center;
        }

        .navbar-nav li {
            list-style: none;
        }

        .navbar-nav li a {
            display: flex;
            align-items: center;
        }

        .navbar-nav li a i {
            margin-right: 8px;
        }

        .container {
            padding: 2rem;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            background-color: #ffffff;
            margin-bottom: 1.5rem;
        }

        .card:hover {
            transform: translateY(-10px);
        }

        .card-title {
            color: #333;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .card-text {
            color: #666;
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

        /* Estilos para los filtros */
        .filter-form {
            margin-top: 2rem;
        }

        .filter-form select, .filter-form input {
            margin-bottom: 10px;
        }

        /* Estilo para las publicaciones */
        .publication-card {
            background-color: #fff;
            box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            cursor: pointer;
        }

        .publication-card:hover {
            transform: translateY(-10px);
        }

        .publication-card img {
            border-radius: 10px 10px 0 0;
            height: 200px;
            object-fit: cover;
        }

        .btn-select {
            background-color: var(--verde-medio);
            border: none;
            padding: 10px 0;
            font-weight: bold;
            border-radius: 20px;
            font-size: 1.1rem;
        }

        .btn-select:hover {
            background-color: var(--verde-claro);
            transform: scale(1.05);
        }
    </style>
</head>
<body>

    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">AlimSolidario</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Cerrar sesión</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contacto.php">Contáctanos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="sobre_nosotros.php">Sobre Nosotros</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <header>
        <h1>Bienvenido, <?php echo $_SESSION['nombre']; ?>!</h1>
        <p>Explora las donaciones disponibles y pide lo que necesitas.</p>
    </header>

    <!-- Filtros -->
    <section class="container filter-form">
        <h2>Filtrar publicaciones</h2>
        <form method="GET" action="dashboard.php">
            <div class="mb-3">
                <label for="categoria" class="form-label">Categoría:</label>
                <select class="form-select" name="categoria" id="categoria">
                    <option value="">Seleccionar categoría</option>
                    <option value="Grano">Grano</option>
                    <option value="Liquido">Liquido</option>
                    <option value="Lacteo">Lacteo</option>
                    <option value="Fruta">Frutas</option>
                    <option value="Verduras">Verduras</option>
                    
                </select>
            </div>
            <div class="mb-3">
                <label for="ubicacion" class="form-label">Ubicación:</label>
                <input type="text" class="form-control" name="ubicacion" id="ubicacion" placeholder="Ciudad, Barrio, etc.">
            </div>
            <div class="mb-3">
                <label for="estado" class="form-label">Estado:</label>
                <select class="form-select" name="estado" id="estado">
                    <option value="">Seleccionar estado</option>
                    <option value="disponible">Disponible</option>
                    <option value="no_disponible">No disponible</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Filtrar</button>
        </form>
    </section>

    <!-- Mostrar las publicaciones disponibles -->
    <section class="container mt-4">
        <h2>Publicaciones Disponibles</h2>
        <div class="row">
            <?php
            if ($result_publicaciones->num_rows > 0) {
                while ($row = $result_publicaciones->fetch_assoc()) {
                    echo "<div class='col-md-4 mb-3'>";
                    echo "<div class='card publication-card'>";
                    echo "<img src='" . $row['imagen'] . "' class='card-img-top' alt='Imagen del producto'>";
                    echo "<div class='card-body'>";
                    echo "<h5 class='card-title'>" . $row['titulo'] . "</h5>";
                    echo "<p class='card-text'>" . substr($row['descripcion'], 0, 100) . "...</p>";
                    echo "<p class='card-text'><strong>Ubicación:</strong> " . $row['ubicacion'] . "</p>";
                    echo "<p class='card-text'><strong>Categoría:</strong> " . $row['categoria'] . "</p>";
                    echo "<a href='#' class='btn btn-primary w-100 btn-select'>Seleccionar</a>";
                    echo "</div>";  // Fin card-body
                    echo "</div>";  // Fin card
                    echo "</div>";  // Fin col-md-4
                }
            } else {
                echo "<div class='alert alert-warning'>No hay publicaciones disponibles en este momento.</div>";
            }
            ?>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2025 AlimSolidario. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>

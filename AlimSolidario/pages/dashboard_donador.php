<?php
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php"); // Redirigir al login si no está logueado
    exit();
}

include('../config/db.php');

// Obtener las publicaciones del donador (filtrar por usuario_id)
$usuario_id = $_SESSION['usuario_id'];
$sql_publicaciones = "SELECT * FROM publicaciones WHERE usuario_id = '$usuario_id' ORDER BY fecha DESC"; // Filtrar por usuario_id
$result_publicaciones = $conn->query($sql_publicaciones);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Donador - AlimSolidario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@700&family=Open+Sans:wght@400&display=swap" rel="stylesheet">
    <style>
        /* Estilos generales */
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

        /* Estilos para el botón "Agregar Publicación" */
        .btn-add {
            background-color: var(--verde-medio);
            color: white;
            padding: 12px 30px;
            border-radius: 5px;
            font-size: 1.1rem;
            margin-bottom: 20px;
        }

        .btn-add:hover {
            background-color: var(--verde-claro);
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
                    <form method="POST" action="login.php">
                        <button type="submit" class="nav-link btn" style="background-color:transparent; border: none; color: white; font-weight: bold;">Cerrar sesión</button>
                    </form>
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
    <p>Administra tus publicaciones de donaciones.</p>
</header>

<!-- Botón para agregar nueva publicación -->
<section class="container mt-4">
    <a href="agregar_publicacion.php" class="btn btn-add">Agregar Publicación</a>
</section>

<!-- Mostrar las publicaciones del donador -->
<section class="container mt-4">
    <h2>Mis Publicaciones</h2>

    <?php
    // Mostrar las publicaciones del donador
    if ($result_publicaciones->num_rows > 0) {
        while ($row = $result_publicaciones->fetch_assoc()) {
            echo "<div class='card mb-3'>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-title'>" . $row['titulo'] . "</h5>";
            echo "<p class='card-text'>" . $row['descripcion'] . "</p>";
            echo "<p class='card-text'><strong>Ubicación:</strong> " . $row['ubicacion'] . "</p>";
            echo "<p class='card-text'><strong>Categoría:</strong> " . $row['categoria'] . "</p>";
            echo "<p class='card-text'><strong>Estado:</strong> " . $row['estado'] . "</p>";
            echo "<a href='editar_publicacion.php?id=" . $row['id'] . "' class='btn btn-warning'>Editar</a>";
            echo "<a href='eliminar_publicacion.php?id=" . $row['id'] . "' class='btn btn-danger'>Eliminar</a>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "<div class='alert alert-warning'>No tienes publicaciones.</div>";
    }
    ?>
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

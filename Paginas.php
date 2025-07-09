<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>AlimSolidario</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="Estilos.css" />
  <style>
    body {
      padding-top: 56px;
    }
    footer {
      background-color: #f8f9fa;
      padding: 1rem 0;
      text-align: center;
      margin-top: 2rem;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
  <div class="container">
    <a class="navbar-brand" href="Paginas.php">AlimSolidario</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="Paginas.php">Inicio</a></li>
        <li class="nav-item"><a class="nav-link" href="Paginas.php?seccion=donar">Donar</a></li>
        <li class="nav-item"><a class="nav-link" href="Paginas.php?seccion=recibir">Recibir</a></li>
        <li class="nav-item"><a class="nav-link" href="Paginas.php?seccion=contacto">Contacto</a></li>

        <?php if (isset($_SESSION['usuario'])): ?>
          <li class="nav-item"><a class="nav-link" href="Paginas.php?seccion=misdonaciones">Mis donaciones</a></li>
          <li class="nav-item">
            <a class="btn btn-outline-light btn-sm mt-1 ms-2" href="cerrar.php">Cerrar sesión</a>
          </li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="Paginas.php?seccion=login">Iniciar sesión</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<main class="container mt-5">
<?php
$seccion = $_GET['seccion'] ?? 'inicio';

switch ($seccion) {
    case 'inicio':
        echo '
        <section id="bienvenida" class="text-center">
          <h1 class="mb-4">Bienvenidos a AlimSolidario</h1>
          <p>Plataforma para reducir el desperdicio de alimentos conectando donadores con personas necesitadas.</p>
          <div class="d-flex justify-content-center gap-3 mt-4">
            <a href="Paginas.php?seccion=login" class="btn btn-outline-primary">Iniciar sesión</a>
            <a href="Paginas.php?seccion=registro" class="btn btn-primary">Registrarse</a>
          </div>';
        break;
    case 'donar':
        include 'Secciones/Donar.php';
        break;
    case 'recibir':
        include 'Secciones/Recibir.php';
        break;
    case 'contacto':
        include 'Secciones/Contacto.php';
        break;
    case 'login':
        include 'Secciones/Login.php';
        break;
    case 'registro':
        include 'Secciones/Registro.php';
        break;
    case 'misdonaciones':
        include 'Secciones/MisDonaciones.php';
        break;
    default:
        echo "<h2 class='text-center text-danger'>Sección no encontrada</h2>";
        break;
}
?>
</main>

<footer>
  &copy; 2025 AlimSolidario - Todos los derechos reservados
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


<?php
include('../config/db.php');

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];
    $rol = $_POST['rol'];
    $telefono = $_POST['telefono'];  // Nuevo campo
    $direccion = $_POST['direccion'];  // Nuevo campo

    // Validaciones básicas
    if (empty($nombre) || empty($correo) || empty($contraseña) || empty($telefono) || empty($direccion)) {
        $error = "Todos los campos son obligatorios.";
    } else {
        // Encriptar la contraseña
        $contraseña_encriptada = password_hash($contraseña, PASSWORD_DEFAULT);

        // Insertar en la base de datos
        $sql = "INSERT INTO usuarios (nombre, correo, contraseña, rol, telefono, direccion) 
                VALUES ('$nombre', '$correo', '$contraseña_encriptada', '$rol', '$telefono', '$direccion')";
        if ($conn->query($sql) === TRUE) {
            $mensaje = "Usuario registrado con éxito.";
        } else {
            $error = "Error al registrar usuario: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - AlimSolidario</title>
    <!-- Vinculación con Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@700&family=Open+Sans:wght@400&display=swap" rel="stylesheet">
    <style>
        /* Paleta de colores */
        :root {
            --verde-oscuro: #1c2a18;
            --verde-medio: #03530dff;
            --verde-claro: #94DEA5;
            --acento: #ff9900;
        }

        /* Estilos generales */
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

        header p {
            font-size: 1.2rem;
            color: var(--verde-claro);
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

        section {
            padding: 4rem 2rem;
            text-align: center;
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

        /* Estilos del formulario */
        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 2rem;
            background-color: #1c2a18; /* Fondo verde oscuro */
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            transition: transform 0.3s ease;
        }

        form:hover {
            transform: translateY(-10px); /* Efecto de elevación */
        }

        .form-label {
            font-weight: bold;
            color: var(--verde-claro); /* Color verde claro */
        }

        .form-control {
            border-radius: 5px;
            font-size: 1rem;
            padding: 0.8rem;
            background-color: #2c3e50; /* Fondo de los campos */
            color: white;
            border: 1px solid #7f8c8d; /* Borde de los campos */
        }

        .form-control:focus {
            background-color: #34495e; /* Fondo más oscuro al enfocarse */
            border-color: var(--acento); /* Cambio de borde en focus */
        }

        .btn-primary {
            background-color: var(--verde-medio);
            border: none;
            font-weight: bold;
            padding: 12px 30px;
            border-radius: 5px;
            font-size: 1.1rem;
            margin-top: 1rem;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: var(--acento);
        }

        .alert {
            padding: 1rem;
            margin-top: 20px;
            font-size: 1rem;
            border-radius: 5px;
        }

        /* Estilos del botón de retroceso */
        .back-btn {
            position: absolute;
            top: 20px;
            left: 20px;
            background-color: #6c757d; /* Color gris */
            color: white;
            padding: 5px 10px;
            font-size: 1rem;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .back-btn:hover {
            background-color: #5a6268; /* Gris más oscuro */
        }

        /* Animaciones */
        .fade-in {
            animation: fadeIn 2s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
</head>
<body>

    <!-- Barra de navegación -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="#">AlimSolidario</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="registro.php"><i class="fas fa-user-plus"></i> Registro</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php"><i class="fas fa-sign-in-alt"></i> Iniciar sesión</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contacto.php"><i class="fas fa-envelope"></i> Contáctanos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="sobre_nosotros.php"><i class="fas fa-info-circle"></i> Sobre Nosotros</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


    <!-- Header -->
    <header>
        <div class="container">
            <h1>Registro de Usuario</h1>
            <p>Únete a AlimSolidario y ayuda a quienes más lo necesitan</p>
        </div>
    </header>

    <!-- Formulario de Registro -->
    <section class="container mt-4 fade-in">
        <form method="POST" action="registro.php">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" id="nombre" name="nombre" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="correo" class="form-label">Correo electrónico:</label>
                <input type="email" id="correo" name="correo" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="contraseña" class="form-label">Contraseña:</label>
                <input type="password" id="contraseña" name="contraseña" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección:</label>
                <input type="text" id="direccion" name="direccion" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="rol" class="form-label">Rol:</label>
                <select id="rol" name="rol" class="form-select" required>
                    <option value="donador">Donador</option>
                    <option value="beneficiario">Beneficiario</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary w-100">Registrarse</button>
        </form>
        <a href="../index.php" class="btn btn-secondary w-100 mt-3">Regresar a la página de inicio</a>

        <?php if (isset($error)) { echo "<div class='alert alert-danger mt-3'>$error</div>"; } ?>
        <?php if (isset($mensaje)) { echo "<div class='alert alert-success mt-3'>$mensaje</div>"; } ?>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 AlimSolidario. Todos los derechos reservados.</p>
    </footer>

    <!-- Scripts de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>

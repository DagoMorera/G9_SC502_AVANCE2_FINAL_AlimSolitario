<?php include('config/db.php'); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AlimSolidario</title>
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
            margin: 0;
            padding: 0;
            color: white;
        }

        /* Barra de navegación */
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

        /* Estilo de Header */
        header {
            background-color: var(--verde-oscuro);
            color: white;
            padding: 3rem 0;
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

        /* Fondo con la imagen y overlay */
        .hero-background {
            position: relative;
             background-image: url('https://media.gettyimages.com/id/1498170916/es/foto/una-pareja-est%C3%A1-llevando-una-bolsa-de-comida-en-el-banco-de-alimentos-y-ropa.jpg?s=612x612&w=gi&k=20&c=rZr-nhiTGFG1-_q8Q4aMzw3NYfvepoGKL-TGogp7VE8='); /* Cambia esta URL por la de tu imagen */
            background-position: center;
             background-size: cover;
             background-repeat: no-repeat;
            height: 90vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
            font-family: 'Quicksand', sans-serif;
        }

        .hero-background::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5); /* Overlay oscuro para hacer el texto legible */
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .hero-background h2 {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .hero-background p {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        /* Footer */
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

    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">AlimSolidario</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="pages/registro.php"><i class="fas fa-user-plus"></i> Registro</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages/login.php"><i class="fas fa-sign-in-alt"></i> Iniciar sesión</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages/contacto.php"><i class="fas fa-envelope"></i> Contáctanos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages/sobre_nosotros.php"><i class="fas fa-info-circle"></i> Sobre Nosotros</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sección Hero con fondo de imagen y texto sobre ella -->
    <section class="hero-background">
        <div class="hero-content">
            <h2>¡Ayúdanos a Combatir el Desperdicio de Comida!</h2>
            <p>Juntos podemos hacer una gran diferencia. Dona alimentos y salva vidas.</p>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2025 AlimSolidario. Todos los derechos reservados.</p>
        </div>
    </footer>

    <!-- Scripts de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>

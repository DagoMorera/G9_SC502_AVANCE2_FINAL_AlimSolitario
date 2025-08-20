<?php include('header.php'); // Incluir encabezado común ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contáctanos - AlimSolidario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Colores y Estilos generales */
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
            padding: 3rem 0;
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

        /* Estilo de formulario */
        .form-container {
            max-width: 500px;
            margin: 0 auto;
            padding: 2rem;
            background-color: #03530dff;
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

        .contact-info {
            text-align: center;
            padding: 2rem 0;
        }

        .social-icons a {
            margin: 0 15px;
            font-size: 2rem;
            color: var(--acento);
        }

    </style>
</head>
<body>

    <!-- Header -->
    <header>
        <h1>Contáctanos</h1>
        <p>Estamos aquí para ayudarte. Si tienes alguna pregunta o sugerencia, no dudes en contactarnos.</p>
    </header>

    <!-- Formulario de contacto -->
    <section class="container mt-4">
        <div class="form-container">
            <h3 class="text-center">Envíanos un mensaje</h3>
            <form method="POST" action="contacto_procesar.php">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="correo" class="form-label">Correo electrónico:</label>
                    <input type="email" id="correo" name="correo" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="mensaje" class="form-label">Mensaje:</label>
                    <textarea id="mensaje" name="mensaje" class="form-control" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary w-100">Enviar Mensaje</button>
            </form>
        </div>
    </section>

    <!-- Información de contacto de los creadores -->
    <section class="container mt-4 contact-info">
        <h3>Información de Contacto</h3>
        <p>Si prefieres contactarnos directamente, aquí tienes nuestra información:</p>
        <p><strong>Correo de contacto:</strong> dmorera90277@ufide.ac.cr//lrodriguez90310@gmail.com//Sdiaz30200@ufide.ac.cr</p>
        <p><strong>Instagram:</strong>andres26031//sebasdiaz04//dgo_1405</p>
        <div class="social-icons">
            <a href="https://www.instagram.com/alimsolidario" target="_blank"><i class="fab fa-instagram"></i></a>
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
    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>

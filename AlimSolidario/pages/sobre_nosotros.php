<?php include('header.php'); // Incluir encabezado común ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Nosotros - AlimSolidario</title>
    <!-- Vinculación con Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Paleta de colores */
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

        .content-section {
            margin-top: 2rem;
            padding: 2rem;
            background-color: white;
            box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .section-text {
            font-size: 1.2rem;
            color: #555;
        }

        /* Botones estilizados */
        .btn-custom {
            background-color: var(--verde-medio);
            color: white;
            font-weight: bold;
            border-radius: 20px;
            padding: 12px 30px;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            background-color: var(--verde-claro);
            transform: scale(1.05);
        }

    </style>
</head>
<body>

    <!-- Header -->
    <header>
        <h1>Sobre AlimSolidario</h1>
        <p>Conoce el impacto de nuestra plataforma en la comunidad y cómo AlimSolidario está cambiando vidas.</p>
    </header>

    <!-- Justificación del Proyecto -->
    <section class="container content-section">
        <div class="section-title">Justificación del Proyecto</div>
        <div class="section-text">
            <p>AlimSolidario nace de la necesidad de ayudar a los más vulnerables en nuestra sociedad. En un mundo donde el desperdicio de alimentos es un problema grave y muchas personas carecen de recursos, esta plataforma busca conectar a donantes con beneficiarios. La app facilita que los productos sean donados de manera eficiente, ayudando a quienes más lo necesitan y generando un impacto positivo en la comunidad.</p>
        </div>
    </section>

    <!-- Impacto en la Sociedad -->
    <section class="container content-section">
        <div class="section-title">Impacto en la Sociedad</div>
        <div class="section-text">
            <p>El objetivo principal de AlimSolidario es reducir el desperdicio de alimentos y proporcionar recursos a las personas más necesitadas. A través de esta plataforma, los donantes pueden hacer una diferencia significativa en la vida de los beneficiarios. A largo plazo, se espera que la app forme una red sólida de apoyo comunitario, no solo en términos de alimentos, sino también de productos esenciales.</p>
            <p>En el futuro, nuestra visión es expandir la plataforma para incluir otros tipos de donaciones, como ropa, muebles y productos médicos. La comunidad será el eje central del proyecto, y con el tiempo, buscamos integrar más funcionalidades que mejoren la experiencia de los usuarios.</p>
        </div>
    </section>

    <!-- Alcance Futuro -->
    <section class="container content-section">
        <div class="section-title">Alcance Futuro</div>
        <div class="section-text">
            <p>AlimSolidario tiene un gran potencial de crecimiento, no solo a nivel local, sino también a nivel global. A medida que más personas se unan al proyecto, podremos ampliar la cobertura geográfica y proporcionar aún más recursos a quienes lo necesiten. Además, la integración de nuevas tecnologías, como la inteligencia artificial para predecir necesidades y optimizar el proceso de donación, jugará un papel clave en el futuro de la plataforma.</p>
        </div>
    </section>

    <!-- Botones para navegar -->
    <section class="container text-center">
        <a href="login.php" class="btn-custom mx-2">Iniciar Sesión</a>
        <a href="registro.php" class="btn-custom mx-2">Registro</a>
        <a href="contacto.php" class="btn-custom mx-2">Contáctanos</a>
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
</body>
</html>

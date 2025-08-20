<?php
include('../config/db.php');
session_start();

// Inicializamos la variable de error
$error = "";

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Comprobar que los campos existan
    $correo = isset($_POST['correo']) ? $_POST['correo'] : '';
    $contraseña = isset($_POST['contraseña']) ? $_POST['contraseña'] : '';

    if (!empty($correo) && !empty($contraseña)) {
        // Sentencia preparada para prevenir inyecciones SQL
        $sql = "SELECT * FROM usuarios WHERE correo = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $correo); // "s" significa string para el correo
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $usuario = $result->fetch_assoc();

            // Verificar la contraseña
            if (password_verify($contraseña, $usuario['contraseña'])) {
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['rol'] = $usuario['rol'];
                $_SESSION['nombre'] = $usuario['nombre']; // Para mostrar el nombre en el dashboard

                // Redirigir al dashboard según el rol
                if ($_SESSION['rol'] === 'donador') {
                    header("Location: ../pages/dashboard_donador.php");
                } else {
                    header("Location: ../pages/dashboard.php");
                }
                exit();
            } else {
                $error = "Contraseña incorrecta.";
            }
        } else {
            $error = "El correo no está registrado.";
        }
    } else {
        $error = "Por favor completa todos los campos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión - AlimSolidario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@700&family=Open+Sans:wght@400&display=swap" rel="stylesheet">
    <style>
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
        header h1 { font-size: 3rem; margin-bottom: 1rem; }
        header p { font-size: 1.2rem; color: var(--verde-claro); }
        .form-container {
            max-width: 400px;
            margin: 2rem auto;
            padding: 2rem;
            background-color: var(--verde-medio);
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
            border-radius: 10px;
        }
        .form-label { font-weight: bold; }
        .btn-primary {
            background-color: var(--verde-oscuro);
            border: none;
            padding: 12px 30px;
            border-radius: 5px;
            font-size: 1.1rem;
            font-weight: bold;
        }
        .btn-primary:hover { background-color: var(--verde-claro); }
        .alert { font-size: 1.1rem; margin-top: 15px; }
        .back-btn { position: absolute; top: 20px; left: 20px; background-color: #6c757d; color: white; padding: 10px 15px; font-size: 1rem; border-radius: 5px; text-decoration: none; }
        .back-btn:hover { background-color: #5a6268; }
    </style>
</head>
<body>

<header>
    <h1>Iniciar sesión</h1>
    <p>Accede a tu cuenta para donar o recibir ayuda.</p>
</header>

<section class="container">
    <div class="form-container">
        <form method="POST" action="login.php">
            <div class="mb-3">
                <label for="correo" class="form-label">Correo electrónico:</label>
                <input type="email" id="correo" name="correo" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="contraseña" class="form-label">Contraseña:</label>
                <input type="password" id="contraseña" name="contraseña" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Iniciar sesión</button>
        </form>

        <?php if (!empty($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>

        <a href="../index.php" class="btn btn-secondary w-100 mt-3">Regresar a la página de inicio</a>
    </div>
</section>

<footer>
    <div class="container">
        <p>&copy; 2025 AlimSolidario. Todos los derechos reservados.</p>
    </div>
</footer>

</body>
</html>

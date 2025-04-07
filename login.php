<?php
include('./src/CRUD.php');
session_start();

$_SESSION['carrito'] = array(); // Inicializar el carrito si no existe



$conn = conectar(); // Conexión a la base de datos
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$errores = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 if (isset($_POST['usuario']) && isset($_POST['contra'])) {
    $usuario = $_POST['usuario'];
    $contra = $_POST['contra'];

        $consulta_preparada = $conn->prepare("SELECT Usuario, Contraseña FROM usuarios WHERE Usuario = :usuario");
        $consulta_preparada->bindParam(':usuario', $usuario);
        $consulta_preparada->execute();

        if ($consulta_preparada->rowCount() > 0) {
            $fila = $consulta_preparada->fetch(PDO::FETCH_ASSOC);
	    
	    if(password_verify($contra, $fila['Contraseña'])){
                $_SESSION['usuario'] = $usuario; // Guardar el usuario en la sesión
                $_SESSION['logged_in'] = true;  // Indicar que el usuario ha iniciado sesión
                header("Location: index.php");
                exit;
            } else {
                $errores[] = "Contraseña incorrecta. Por favor, inténtalo de nuevo.";
            }
        } else {
            $errores[] = "El usuario ingresado no existe.";
        }
    }
}

function mostrar_errores($errores) {
    if (!empty($errores)) {
        echo "<div class='error-messages'>";
        foreach ($errores as $error) {
            echo "<p>" . htmlspecialchars($error) . "</p>";
        }
        echo "</div>";
    }
}

$conn = null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - WANNABOOK</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        .login-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            background-color: #fff;
        }

        .login-container h1 {
            text-align: center;
            font-family: 'Raleway', sans-serif;
            margin-bottom: 20px;
        }

        .login-container label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        .login-container button {
            width: 100%;
            padding: 10px;
            background-color: #302f4d;
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        .login-container button:hover {
            background-color: #1f1e36;
        }

        .login-container a {
            color: #302f4d;
            text-decoration: none;
        }

        .login-container a:hover {
            text-decoration: underline;
        }

        .error-messages {
            margin-top: 10px;
            color: red;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <div class="navbar color-4">
        <a href="./" class="nav-btn raleway-regular color-4 no-link-style">WANNABOOK</a>
    </div>

    <div class="login-container raleway-regular color-f-2">
        <h1>Iniciar Sesión</h1>
        <form method="post" action="">
            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario" required>

            <label for="contra">Contraseña:</label>
            <input type="password" id="contra" name="contra" required>

            <button type="submit">Iniciar Sesión</button>

            <p style="margin-top: 15px;">¿No tienes una cuenta? <a href="register.php">Regístrate aquí</a></p>

            <?php mostrar_errores($errores); ?>
        </form>
    </div>

</body>
</html>

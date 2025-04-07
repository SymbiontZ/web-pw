<?php

include('./src/CRUD.php');
include('./src/validators.php');

$conn = conectar(); // Conexión a la base de datos
 //Usamos el modo de PDO de excepciones.
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$errores = [];

function mostrar_errores($errores) {
    if (!empty($errores)) {
        echo "<div class='error-messages'>";
        foreach ($errores as $error) {
            echo "<p>" . htmlspecialchars($error) . "</p>";
        }
        echo "</div>";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['usuario']) && isset($_POST['contra'])) {
        $usuario = $_POST['usuario'];
        $contra = $_POST['contra'];

        $consulta_preparada = $conn->prepare("SELECT id FROM usuarios WHERE usuario = :usuario");
            $consulta_preparada->bindParam(':usuario', $usuario, PDO::PARAM_STR);
            $consulta_preparada->execute();

        if ($consulta_preparada->rowCount() > 0) {
            $errores[] = "El nombre de usuario ya está en uso. Por favor, elige otro.";
        } else {

            if (!validar_contrasena($contra)) {
               $errores[] = "La contraseña no es válida. Debe contener entre 8 y 20 caracteres, al menos una letra mayúscula, una letra minúscula, un número y un carácter especial.";
            } else {
                // Si el usuario y la contraseña son válidos, se procede a insertar en la base de datos
                $consulta_preparada_insertar = $conn->prepare("INSERT INTO usuarios (usuario, contraseña) VALUES (:usuario, :contrasena)");
                $consulta_preparada_insertar->bindParam(':usuario', $usuario, PDO::PARAM_STR);
                $consulta_preparada_insertar->bindParam(':contrasena', $contra, PDO::PARAM_STR);

                // Hashear la contraseña antes de almacenarla

            $hashed_password = password_hash($contra, PASSWORD_DEFAULT);

	    $consulta_preparada_insertar = $conn->prepare("INSERT INTO usuarios (usuario, contraseña) VALUES (:usuario, :contrasena)");
            $consulta_preparada_insertar->bindParam(':usuario', $usuario, PDO::PARAM_STR);
            $consulta_preparada_insertar->bindParam(':contrasena', $hashed_password, PDO::PARAM_STR);

            if ($consulta_preparada_insertar->execute() === TRUE) {
                echo "Usuario registrado exitosamente. Puedes iniciar sesión ahora.";
		    	header("Location: login.php");
            } else {
                $errores[] =  "Error al registrar el usuario: ";
            }


        }
    }
}

// Cerrar la conexión
$conn = null;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - WANNABOOK</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        .register-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            background-color: #fff;
        }

        .register-container h1 {
            text-align: center;
            font-family: 'Raleway', sans-serif;
            margin-bottom: 20px;
        }

        .register-container label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .register-container input[type="text"],
        .register-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        .register-container button {
            width: 100%;
            padding: 10px;
            background-color: #302f4d;
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        .register-container button:hover {
            background-color: #1f1e36;
        }

        .register-container a {
            color: #302f4d;
            text-decoration: none;
        }

        .register-container a:hover {
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

    <div class="register-container raleway-regular color-f-2">
        <h1>Crear Cuenta</h1>
        <form method="post" action="">
            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario" required>

            <label for="contra">Contraseña:</label>
            <input type="password" id="contra" name="contra" required>

            <button type="submit">Registrarse</button>

            <p style="margin-top: 15px;">¿Ya tienes una cuenta? <a href="login.php">Inicia sesión aquí</a></p>

            <?php mostrar_errores($errores); ?>
        </form>
    </div>

</body>
</html>

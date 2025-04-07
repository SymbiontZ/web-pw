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
    <title>Registrar Usuario</title>
</head>
<body>
    <h1>Registrar Usuario</h1>
    <form method="post" action="">

        <label for="usuario">Usuario:</label><br>
        <input type="text" id="usuario" name="usuario" required><br><br>

        <label for="contra">Contraseña:</label><br>
        <input type="password" id="contra" name="contra" required><br><br>

        <button type="submit">Registrar</button>
    </form>
    <p>¿Ya tienes una cuenta? <a href="login.php">Inicia sesión aquí</a></p>
    <?php mostrar_errores($errores); ?>
</body>
</html>

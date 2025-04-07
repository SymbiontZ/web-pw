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
    <title>Iniciar Sesion</title>
</head>
<body>
    <h1>Iniciar Sesion</h1>
    <form method="post" action="">

        <label for="usuario">Usuario:</label><br>
        <input type="text" id="usuario" name="usuario" required><br><br>    

        <label for="contra">Contraseña:</label><br>
        <input type="password" id="contra" name="contra" required><br><br>

        <button type="submit">Iniciar Sesion</button>
        <p>¿No tienes una cuenta? <a href="register.php">Regístrate aquí</a></p>
        <?php mostrar_errores($errores); ?>
    </form>



</body>
</html>

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

<?php
$servername = "localhost";
$username = "pw"; // Usuario de la base de datos
$password = "pw"; // Contraseña de la base de datos
$dbname = "tienda_libros"; // Nombre de la base de datos

 $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
 //Usamos el modo de PDO de excepciones.
 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['usuario']) && isset($_POST['contra'])) {
        $usuario = $_POST['usuario'];
        $contra = $_POST['contra'];

	$consulta_preparada = $conn->prepare("SELECT id FROM usuarios WHERE usuario = :usuario");
        $consulta_preparada->bindParam(':usuario', $usuario, PDO::PARAM_STR);
        $consulta_preparada->execute();

        if ($consulta_preparada->num_rows > 0) {
            echo "El nombre de usuario ya está en uso. Por favor, elige otro.";
        } else {
            $hashed_password = password_hash($contra, PASSWORD_DEFAULT);

	    $consulta_preparada_insertar = $conn->prepare("INSERT INTO usuarios (usuario, contraseña) VALUES (:usuario, :contrasena)");
            $consulta_preparada_insertar->bindParam(':usuario', $usuario, PDO::PARAM_STR);
            $consulta_preparada_insertar->bindParam(':contrasena', $hashed_password, PDO::PARAM_STR);

            if ($consulta_preparada_insertar->execute() === TRUE) {
                echo "Usuario registrado exitosamente. Puedes iniciar sesión ahora.";
		header("Location: InicioSesion.php");
            } else {
                echo "Error al registrar el usuario: ";
            }
        }
    }
}

// Cerrar la conexión
$conn = null;
?>

</body>
</html>

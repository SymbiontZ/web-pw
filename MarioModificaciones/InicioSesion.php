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
    </form>

<?php
$servername = "localhost";
$username = "pw";
$password = "pw";
$dbname = "tienda_libros";

$conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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
                echo "Bienvenido, " . $usuario . "!";
                header("Location: index.php");
            } else {
                echo "Contraseña incorrecta";
            }
        } else {
            echo "Usuario no encontrado";
        }
    }
}

$conn = null;
?>

</body>
</html>

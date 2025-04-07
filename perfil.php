<?php
session_start();

include ('./src/CRUD.php');
include ('./src/helpers.php');

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header('Location: login.php');
    exit;
}
$usuario = $_SESSION['usuario'];

if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: index.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    
</head>
<body>
    <?php render_navbar(); ?>

    <div class="container" style="margin-top: 60px; margin-left: 20px;">
        <h1>Perfil de Usuario</h1>
        <p><strong>Nombre de usuario:</strong> <?php echo htmlspecialchars($usuario); ?></p>
        <?php if (isAdmin($usuario)): ?>
            <p><strong>Rol:</strong> Administrador</p>
            <a href="./admin/usuarios.php" class="btn">Administrar Usuarios</a>
            
            <a href="./admin/libros.php" class="btn">Administrar Libros</a>
        <?php else: ?>
            <p><strong>Rol:</strong> Usuario</p>
        <?php endif; ?>

        <form method="post" action="">
            <button type="submit" name="logout" class="btn">Cerrar sesión</button>
        </form>
    </div>
</body>
</html>

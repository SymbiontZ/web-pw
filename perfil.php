<?php
session_start();

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
<div class="navbar color-4 d-flex align-items-center justify-between">
        <a href="./" class="nav-btn raleway-regular color-4 no-link-style">WANNABOOK</a>
        <div class="nav-group d-flex align-items-center">
            <?php if (!$_SESSION['logged_in']): ?>
                <a href="login.php" class="nav-btn raleway-regular color-4 no-link-style">Login</a>
            <?php else: ?>
                <a href="perfil.php" class="nav-btn raleway-regular color-4 no-link-style">Perfil</a>
            <?php endif; ?>
            <a href="carrito.php" class="nav-btn raleway-regular color-4 no-link-style" style="position: relative;">
                <i class="fas fa-shopping-cart"></i>
                <?php 
                $total_items = 0;
                foreach ($_SESSION['carrito'] as $item) {
                    $total_items += $item['cantidad'];
                }
                if ($total_items > 0): ?>
                    <span style="position: absolute; top: -5px; right: -5px; background-color: red; color: white; border-radius: 50%; width: 15px; height: 15px; display: flex; align-items: center; justify-content: center; font-size: 12px;">
                        <?php echo $total_items; ?>
                    </span>
                <?php endif; ?>
            </a>
        </div>
    </div>

    <div class="container">
        <h1>Perfil de Usuario</h1>
        <p><strong>Nombre de usuario:</strong> <?php echo htmlspecialchars($usuario); ?></p>
        <form method="post" action="">
            <button type="submit" name="logout" class="btn">Cerrar sesión</button>
        </form>
    </div>
</body>
</html>

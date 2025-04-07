<?php

session_start();

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array();
}

include('./src/CRUD.php');

// Verifica si se pasa un id_libro en la URL
if (isset($_GET['id_libro'])) {
    $id_libro = intval($_GET['id_libro']); // Sanitiza el parámetro recibido
    $libro = obtenerLibroPorId($id_libro); // Función para obtener los detalles del libro

    if (is_object($libro)) {
        // Muestra los detalles del libro
        echo "<br><br><br><h1>" . htmlspecialchars($libro->get_titulo()) . "</h1>";
        echo "<p>Autor: " . htmlspecialchars($libro->get_autor()) . "</p>";
        echo "<p>Precio: " . number_format($libro->get_precio(), 2) . "€</p>";
        echo "<p>Páginas: " . htmlspecialchars($libro->get_numPags()) . "</p>";
        echo "<p>Fecha de publicación: " . htmlspecialchars($libro->get_fecha()) . "</p>";
        echo "<p>Categorías: " . implode(', ', $libro->get_categorias()) . "</p>";
        echo "<p>Sinopsis: " . htmlspecialchars($libro->get_sinopsis()) . "</p>";
        echo "<p>Editorial: " . htmlspecialchars($libro->get_editorial()) . "</p>";
        echo "<img src='./data/" . htmlspecialchars($libro->get_url()) . "' alt='" . htmlspecialchars($libro->get_titulo()) . "'>";
        $titulo = htmlspecialchars($libro->get_titulo()) . " | " . htmlspecialchars($libro->get_autor());
    } else {
        echo "<p>Libro no encontrado.</p>";
        $titulo = "LIBRO NO ENCONTRADO";
    }
} else {
    echo "<p>No se especificó un libro.</p>";
    $titulo = "LIBRO NO ENCONTRADO";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo;?></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
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

    <div style="margin-top: 80px; padding: 0 20px;">
        <div class="align-center d-flex">
            <p class="section-title raleway-regular">Más vendidos</p>
            <a class="ml-2 mt-5 no-link-style color-f-2 raleway-regular" href="./">Ver más</a>
        </div>
    </div>
        
        
    
</body>
</html>
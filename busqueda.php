<?php
session_start();

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array();
}
if (!isset($_SESSION['logged_in'])) {
    $_SESSION['logged_in'] = false;
}
if (!isset($_SESSION['usuario'])) {
    $_SESSION['usuario'] = null;
}

include ('./src/CRUD.php');
define('IMAGEN_DIR', './data');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['busqueda'])) {
        $busqueda = $_POST['busqueda'];
        $libros = buscarLibros($busqueda);
    } else {
        $libros = []; // Inicializar como vacío si no hay búsqueda
    }
}

function mostrar_libros($libros): void {
    if (count($libros) > 0) {
        echo "<div class='product-list'>";
        foreach ($libros as $libro) {
            echo "  <div class='product-container justify-center max-w color-1'>";
            echo "      <img src='" . IMAGEN_DIR . "/" . htmlspecialchars($libro->get_url()) . "' alt='" . htmlspecialchars($libro->get_titulo()) . "' style='width: 100%; height: auto; border-radius: 8px;'>";
            echo "      <h2>" . htmlspecialchars($libro->get_titulo()) . "</h2>";
            echo "      <p>" . htmlspecialchars($libro->get_autor()) . "</p>";
            echo "      <p>" . number_format($libro->get_precio(), 2) . "€</p>";
            echo "      <form method='POST' action=''>";
            echo "          <input type='hidden' name='id_libro' value='" . $libro->get_id() . "'>";
            echo "          <button type='submit' name='añadir_carrito' class='btn-add'>Añadir al carrito</button>";
            echo "      </form>";
            echo "  </div>";
        }
        echo "</div>";
    } else {
        echo "<p>No se encontraron resultados.</p>";
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $busqueda ?> en WANNABOOK</title>
    <link rel="stylesheet" href="style.css"> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="navbar color-4 d-flex align-center justify-between">
        <div class="nav-left">
            <a href="./" class="nav-btn raleway-regular color-4 no-link-style">WANNABOOK</a>
        </div>
        <div class="nav-center">
            <form method="POST" action="">
                <input type="text" name="busqueda" placeholder="Buscar..." class="search-input">
                <button type="submit" name="buscar" class="search-btn"><i class="fas fa-search"></i></button>
            </form>
        </div>
        <div class="nav-right">
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
        <h1>Resultados de la búsqueda para "<?php echo htmlspecialchars($busqueda); ?>"</h1>
        <?php if (empty($libros)): ?>
            <p>No se encontraron resultados.</p>
        <?php else: ?>
            <?php mostrar_libros($libros)?>
        <?php endif; ?>
    </div>      
</body>
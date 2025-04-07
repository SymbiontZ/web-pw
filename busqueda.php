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
include ('./src/helpers.php');
define('IMAGEN_DIR', './data');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['busqueda'])) {
        $busqueda = $_POST['busqueda'];
        $_SESSION['busqueda'] = $busqueda; //Almacenar la búsqueda en la sesión
    } else {
        $busqueda = $_SESSION['busqueda'] ?? ''; //Usar la búsqueda almacenada en la sesión como backup
    }
    $libros = buscarLibros($busqueda);
} else {
    $busqueda = $_SESSION['busqueda'] ?? ''; //Almacenar la búsqueda en la sesión
    $libros = [];
}

function mostrar_libros($libros): void {
    if (count($libros) > 0) {
        echo "<div class='product-list'>";
        foreach ($libros as $libro) {
            echo "  <div class='product-container justify-center max-w color-1'>";
            echo "      <a href='detalles.php?id_libro=" . htmlspecialchars($libro->get_id()) . "'>";
            echo "          <img class = 'justify-center d-flex max-w' src='./data/". $libro->get_url()."' alt='".$libro->get_titulo()."-".$libro->get_autor()."'>";
            echo "      </a>";
            echo "      <hr>";
            
            echo "      <div>";
            echo "          <a class='size-18 bold black-text no-link-style text-multiline-truncate' href='https://example.com'>" . htmlspecialchars(strtoupper($libro->get_titulo())) . "</a>";
            echo "          <p class='size-14 low-margin-v'>" . htmlspecialchars($libro->get_autor()) . "</p>";
            echo "          <p class='size-16 bold text-right mt-20 mb-1'>" . number_format($libro->get_precio(), 2) . "€ </p>";
            echo "          <form method='post' action=''>";
            echo "              <input type='hidden' name='id_libro' value='" . htmlspecialchars($libro->get_id()) . "'>";
            echo "              <button type='submit' name='añadir' class='hover-btn jetbrains-mono-regular color-3'>";
            echo "                  <i class='fas fa-cart-plus icon'></i>";
            echo "              </button>";
            echo "          </form>";
            echo "      </div>";
            echo "  </div>";
        }
        echo "</div>";
    } else {
        echo "<p>No se encontraron resultados.</p>";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['añadir']) && isset($_POST['id_libro'])) {
        $id = (int) $_POST['id_libro'];
        $encontrado = false;

        foreach ($_SESSION['carrito'] as $index => $item) {
            if ($item['id'] === $id) {
                $_SESSION['carrito'][$index]['cantidad']++;
                $encontrado = true;
                break;
            }
        }

        if (!$encontrado) {
            $_SESSION['carrito'][] = ['id' => $id, 'cantidad' => 1];
        }
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
    <?php render_navbar(); ?>

    <div style="margin-top: 80px; padding: 0 20px;">
        <h1>Resultados de la búsqueda para "<?php echo htmlspecialchars($busqueda); ?>"</h1>
        <?php if (empty($libros)): ?>
            <p>No se encontraron resultados.</p>
        <?php else: ?>
            <?php mostrar_libros($libros)?>
        <?php endif; ?>
    </div>      
</body>
</html>
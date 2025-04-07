<?php

session_start();

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array();
}

include('./src/CRUD.php');
include('./src/helpers.php');

$libro = null;

// Verifica si se pasa un id_libro en la URL
if (isset($_GET['id_libro'])) {
    $id_libro = intval($_GET['id_libro']); // Sanitiza el parámetro recibido
    $libro = obtenerLibroPorId($id_libro); // Función para obtener los detalles del libro
}

function mostrar_libro($libro): void {
    if (is_object($libro)) {
        echo '
        <div class="book-container d-flex align-center justify-center max-w color-1" style="margin-top: 60px; margin-left: 20px; display: flex; flex-wrap: wrap;">
            <div style="flex: 1; max-width: 25%; padding: 10px;">
                <img src="./data/' . htmlspecialchars($libro->get_url(), ENT_QUOTES, 'UTF-8') . '" alt="' . htmlspecialchars($libro->get_titulo(), ENT_QUOTES, 'UTF-8') . '" class="max-w border-rounded shadow">
            </div>
            <div class="book-info" style="flex: 1; max-width: 60%; padding: 10px;">
                <h1 class="section-title">' . htmlspecialchars($libro->get_titulo(), ENT_QUOTES, 'UTF-8') . '</h1>
                <p><strong>Autor:</strong> ' . htmlspecialchars($libro->get_autor(), ENT_QUOTES, 'UTF-8') . '</p>
                <p><strong>Precio:</strong> ' . number_format($libro->get_precio(), 2) . '€</p>
                <p><strong>Páginas:</strong> ' . htmlspecialchars($libro->get_numPags(), ENT_QUOTES, 'UTF-8') . '</p>
                <p><strong>Fecha de publicación:</strong> ' . htmlspecialchars($libro->get_fecha(), ENT_QUOTES, 'UTF-8') . '</p>
                <p><strong>Categorías:</strong> ' . htmlspecialchars(implode(', ', $libro->get_categorias()), ENT_QUOTES, 'UTF-8') . '</p>
                <p><strong>Editorial:</strong> ' . htmlspecialchars($libro->get_editorial(), ENT_QUOTES, 'UTF-8') . '</p>
                <p><strong>Sinopsis:</strong> ' . htmlspecialchars($libro->get_sinopsis(), ENT_QUOTES, 'UTF-8') . '</p>
                <form method="post" action="">
                    <input type="hidden" name="id_libro" value="' . htmlspecialchars($libro->get_id(), ENT_QUOTES, 'UTF-8') . '">
                    <button type="submit" name="añadir" class="color-3 book-cart-btn">
                        <i class="fas fa-cart-plus icon" style="color: white;"></i>
                    </button>
                </form>
            </div>
        </div>';
    } else {
        echo "<p class='text-danger text-center'>Libro no encontrado.</p>";
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
    <title><?php echo $libro->get_titulo()." | ".$libro->get_autor();?></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php render_navbar(); ?>
    <div>
        <div class="container" style="margin-top: 60px; margin-left: 20px;">
            <?php mostrar_libro($libro); ?>
        </div>
    </div>
    
</body>
</html>
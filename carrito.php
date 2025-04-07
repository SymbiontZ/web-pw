<?php
session_start();

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array();
}


include ('./src/CRUD.php');
include ('./src/helpers.php');

define('IMAGEN_DIR', './data');

$errores = [];
// Ejemplo de productos en el carrito (puedes reemplazarlo con datos reales)

function calcularTotal($carrito) {
    $total = 0;
    foreach ($carrito as $item) {
        $libro = obtenerLibroPorId($item['id']); // Asumiendo que tienes una función para obtener el libro por ID
        $total += $item['cantidad'] * $libro->get_precio(); // Asumiendo que el objeto libro tiene un método get_precio()
    }
    return $total;
}

function mostrar_carrito(): void {
    echo "<h2 class='section-title raleway-regular'>Tu carrito</h2>";

    if (!empty($_SESSION['carrito'])) {
        $total = 0;

        foreach ($_SESSION['carrito'] as $item) {
            $libro = obtenerLibroPorId($item['id']);
            if (!$libro) {
                echo "Libro con ID {$item['id']} no encontrado";
                continue;
            }

            echo "<div class='carrito-item d-flex align-center mb-4' style='gap: 15px;'>";

            // Imagen de portada desde ./data/
            echo "<img src='" . IMAGEN_DIR . "/" . htmlspecialchars($libro->get_url()) . "' alt='" . htmlspecialchars($libro->get_titulo()) . "' style='width: 80px; height: auto; border-radius: 8px;'>";

            // Título, cantidad y precio
            echo "<div>";
            echo "<p class='raleway-regular color-f-2' style='margin: 0;'>" . htmlspecialchars($libro->get_titulo());
            if ($item['cantidad'] > 1) {
                echo " <span class='cantidad'>(x" . $item['cantidad'] . ")</span>";
            }
            echo "</p>";
            echo "<p class='raleway-regular color-f-2' style='margin: 4px 0;'>" . number_format($libro->get_precio(), 2) . "€</p>";

            // Botón Quitar
            echo "<form method='POST' style='display:inline'>";
            echo "  <input type='hidden' name='id_libro' value='" . $libro->get_id() . "'>";
            echo "  <button type='submit' name='eliminar' class='btn-quitar'>Quitar</button>";
            echo "</form>";
            echo "</div>"; // fin info

            echo "</div>"; // fin carrito-item

            $total += $item['cantidad'] * $libro->get_precio();
        }

        // Total y botón de pago
        echo "<p class='raleway-regular color-f-2 mt-4'><strong>Total: " . number_format($total, 2) . "€</strong></p>";
        echo "<form method='POST'><button type='submit' name='pago' class='btn-pago'>Pagar</button></form>";
    } else {
        echo "<p class='raleway-regular color-f-2'>Tu carrito está vacío.</p>";
    }

}


if (isset($_POST['eliminar'])) {
    $id = (int) $_POST['id_libro'];
    $_SESSION['carrito'] = array_filter($_SESSION['carrito'], fn($item) => $item['id'] !== $id);
}


if (isset($_POST['pago'])) {
    if (isset($_SESSION['usuario'])) {
        $usuario = devolverIdPorNombre($_SESSION['usuario']);
        foreach ($_SESSION['carrito'] as $item) {
            registrarCompra($item['id'], $usuario, $item['cantidad']); // Asumiendo que tienes una función para registrar la compra
        }
        $_SESSION['carrito'] = []; // Vaciar el carrito
        header("Location: " . $_SERVER['PHP_SELF']); // Evita el reenvío
        exit;
    } else {
        $errores[] = "Debes iniciar sesión para pagar.";
        header("Location: login.php");

    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cesta Compras | WANNABOOK</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php render_navbar(); ?>

    <header style="margin-top: 60px;">
        <h1>Carrito de Compras</h1>
    </header>
    <main>
        <section id="cart" style="margin-top: 65px; margin-left: 20px;">
            <?php mostrar_carrito(); ?>
        </section>
    </main>
</body>
</html>
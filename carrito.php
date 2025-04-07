<?php
session_start();

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array();
}

include ('./src/CRUD.php');

// Ejemplo de productos en el carrito (puedes reemplazarlo con datos reales)

function calcularTotal($carrito) {
    $total = 0;
    foreach ($carrito as $item) {
        $libro = obtenerLibroPorId($item['id']); // Asumiendo que tienes una función para obtener el libro por ID
        $total += $item['cantidad'] * $libro->get_precio(); // Asumiendo que el objeto libro tiene un método get_precio()
    }
    return $total;
}

function mostrarCarrito($carrito) {
    if (!empty($carrito)) {
        foreach ($carrito as $item) {
            $libro = obtenerLibroPorId($item['id']); // Asumiendo que tienes una función para obtener el libro por ID
            echo '<tr>';
            echo '<td>' . htmlspecialchars($libro->get_titulo()) . '</td>';
            echo '<td>' . htmlspecialchars($item['cantidad']) . '</td>';
            echo '<td>$' . number_format($libro->get_precio(), 2) . '</td>';
            echo '<td>';
            echo '  <form method="post" action="">';
            echo '      <input type="hidden" name="id_libro" value="' . htmlspecialchars($item['id']) . '">';
            echo '      <button type="submit" name="eliminar">Eliminar</button>';
            echo '  </form>';
            echo '</td>';
            echo '</tr>';
        }
    } else {
        echo '<tr>';
        echo '<td colspan="5">El carrito está vacío.</td>';
        echo '</tr>';
    }
}


if (isset($_POST['eliminar'])) {
    $id = (int) $_POST['id_libro'];
    $_SESSION['carrito'] = array_filter($_SESSION['carrito'], fn($item) => $item['id'] !== $id);
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

    <header>
        <h1>Carrito de Compras</h1>
    </header>
    <main>
        <section id="cart" style="margin-top: 65px;">
            <table>
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php mostrarCarrito($_SESSION['carrito']); ?>
                </tbody>
            </table>
        </section>
        <section id="summary">
            <h2>Resumen</h2>
            <p>Total: <span id="total-price">$<?php echo number_format(calcularTotal($_SESSION['carrito']), 2); ?></span></p>
            <button id="checkout-button">Finalizar Compra</button>
        </section>
    </main>
</body>
</html>
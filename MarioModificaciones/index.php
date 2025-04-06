<?php
    session_start();
    
    // Iniciar carrito si no existe
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    include ('./src/CRUD.php');

    define('IMAGEN_DIR', './data');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['añadir_carrito'])) {
            $id = (int) $_POST['id_libro'];
            if (!in_array($id, $_SESSION['carrito'])) {
                $_SESSION['carrito'][] = $id;
            }
        }

        if (isset($_POST['eliminar_carrito'])) {
            $id = (int) $_POST['id_libro'];
            $_SESSION['carrito'] = array_filter($_SESSION['carrito'], fn($item) => $item != $id);
        }
    
        if (isset($_POST['pago'])) {
            $total = 0;
            foreach ($_SESSION['carrito'] as $id) {
                $libro = obtenerLibroPorId($id);
                if ($libro) $total += $libro->get_precio();
            }
            $_SESSION['carrito'] = []; // Vaciar carrito tras pago
            $_SESSION['mensaje'] = "Gracias por su compra. El total fue de " . number_format($total, 2) . "€.";
        }
    }

    function mostrar_libros($orden): void{
        /** @var Libro[] $lista */
        $lista = [];

        switch ($orden) {
            case 'descarga':
                $lista = devolverLibros();  
                break;
            case 'fecha':
                $lista = devolverLibros();
                break;
                
            default:
                break;
        }
        
        if(count($lista) > 0){
            echo "<div class='product-list'>";
            foreach ($lista as $libro) {
                echo "  <div class='product-container justify-center max-w color-1'>";
                echo "      <a href='detalles.php?id_libro=" . htmlspecialchars($libro->get_id()) . "'>";
                echo "          <img class = 'justify-center d-flex max-w' src='./data/". $libro->get_url()."' alt='".$libro->get_titulo()."-".$libro->get_autor()."'>";
                echo "      </a>";
                echo "      <hr>";
                
                echo "      <div>";
                echo "          <a class='size-18 bold black-text no-link-style text-multiline-truncate' href='https://example.com'>" . htmlspecialchars(strtoupper($libro->get_titulo())) . "</a>";
                echo "          <p class='size-14 low-margin-v'>" . htmlspecialchars($libro->get_autor()) . "</p>";
                echo "          <p class='size-16 bold text-right mt-20 mb-1'>" . number_format($libro->get_precio(), 2) . "€ </p>";
                echo "          <form method='POST'>";
                echo "          <input type='hidden' name='id_libro' value='" . $libro->get_id() . "'>";
                echo "          <button type='submit' name='añadir_carrito' class='hover-btn jetbrains-mono-regular color-3'>";
                echo "          <i class='fas fa-cart-plus icon'></i> Añadir al carrito";
                echo "          </button>";
                echo "          </form>";
                echo "      </div>";
                echo "  </div>";
            }
            echo "</div>";
        }else{
            echo "No hay resultados de esta busqueda. Intenta con otra.";
        }

    }

    function mostrar_carrito(): void {
        echo "<h2>Tu carrito</h2>";
        if (!empty($_SESSION['carrito'])) {
            $total = 0;
            foreach ($_SESSION['carrito'] as $id) {
                $libro = obtenerLibroPorId($id);
                if ($libro) {
                    echo "<div class='carrito-item'>";
                    echo "<p>" . htmlspecialchars($libro->get_titulo()) . " - " . number_format($libro->get_precio(), 2) . "€</p>";
                    echo "<form method='POST' style='display:inline'>";
                    echo "  <input type='hidden' name='id_libro' value='" . $libro->get_id() . "'>";
                    echo "  <button type='submit' name='eliminar_carrito'>Quitar</button>";
                    echo "</form>";
                    echo "</div>";
                    $total += $libro->get_precio();
                }
            }
            echo "<p><strong>Total: " . number_format($total, 2) . "€</strong></p>";
            echo "<form method='POST'><button type='submit' name='pago'>Pagar</button></form>";
        } else {
            echo "<p>Tu carrito está vacío.</p>";
        }
    
        if (isset($_SESSION['mensaje'])) {
            echo "<p style='color: green;'>" . $_SESSION['mensaje'] . "</p>";
            unset($_SESSION['mensaje']);
        }
    }
    ?>

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WANNABOOK</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="navbar color-4">
        <button href="./" class="nav-btn raleway-regular color-4">WANNABOOK</button>
    </div>

    <div style="margin-top: 80px; padding: 0 20px;">
        <div class="align-center d-flex">
            <p class="section-title raleway-regular">Más vendidos</p>
            <a class="ml-2 mt-5 no-link-style color-f-2 raleway-regular" href="./">Ver más</a>
        </div>
        <hr>
        <?php mostrar_libros('descarga'); ?>
    </div>
    <div>
        <div class="align-center d-flex">
            <p class="vertical-text bold size-28" >Más recientes</p>
            <a class="vertical-text" href="./">Ver más</a>
        </div>
        <hr>
        <?php mostrar_libros('fecha'); ?>
    </div>
        
    <div style="padding: 20px;">
        <?php mostrar_carrito(); ?> <!-- MOVER AQUÍ -->
    </div> 
</body>

</form>
</html>
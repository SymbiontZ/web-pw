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

    function mostrar_libros($orden): void{
        /** @var Libro[] $lista */
        $lista = [];

        switch ($orden) {
            case 'descarga':
                $lista = devolverLibrosDescarga();  
                break;
            case 'fecha':
                $lista = devolverLibrosFecha();
                break;
            case 'titulo':
                $lista = devolverLibrosAlfabeto();
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
        }else{
            echo "No hay resultados de esta busqueda. Intenta con otra.";
        }

    }
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
    <?php render_navbar(); ?>

    <div style="margin-top: 80px; padding: 0 20px;">
        <div class="align-center d-flex">
            <p class="section-title raleway-regular">Más vendidos</p>
            <a class="ml-2 mt-5 no-link-style color-f-2 raleway-regular" href="./">Ver más</a>
        </div>
        <hr>
        <?php mostrar_libros('descarga'); ?>
    </div>
    <div class="px-20 mt-20">
        <div class="align-center d-flex">
            <p class="section-title raleway-regular" >Más recientes</p>
            <a class="ml-2 mt-5 no-link-style color-f-2 raleway-regular" href="./">Ver más</a>
        </div>
        <hr>
        <?php mostrar_libros('fecha'); ?>
    </div>
    <div class="px-20 mt-20">
        <div class="align-center d-flex">
            <p class="section-title raleway-regular" >De la A a la Z</p>
            <a class="ml-2 mt-5 no-link-style color-f-2 raleway-regular" href="./">Ver más</a>
        </div>
        <hr>
        <?php mostrar_libros('titulo'); ?>
    </div>
        
        
    
</body>
</html>
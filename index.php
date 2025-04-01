<?php
    include('src/clases.php');

    define('IMAGEN_DIR', './data');

    function mostrar_libros($orden){
        /** @var Libro[] $lista */
        $lista = [];

        switch ($orden) {
            case 'descarga':
                $lista[] = new Libro(
                    "El Señor de los Anillos", 
                    "J.R.R. Tolkien",
                    19.99,
                    1216, 
                    "1954-07-29", 
                    "el-senor-de-los-anillos.jpg", 
                    ["Fantasía", "Aventura"]
                );
                break;
            case 'fecha':
                $lista[] = new Libro(
                    "El Quijote", 
                    "Miguel de Cervantes",
                    24.99,
                    863, 
                    "1605-01-16", 
                    "el-quijote.jpg", 
                    ["Clásico", "Novela"]
                );
                break;
                
            default:
                break;
        }
        
        if(count($lista) > 0){
            echo "<div class='products-container'>";
            foreach ($lista as $libro) {
                echo "<div class='product-list d-flex justify-center'>";
                echo "  <div class='product-container justify-center max-w'";
                echo "      <a  href='https://example.com'>";
                echo "          <img class = 'justify-center d-flex max-w' src='./data/". $libro->get_url()."' alt='".$libro->get_titulo()."-".$libro->get_autor()."'>";
                echo "      </a>";
                echo "      <hr>";
                
                echo "      <div>";
                echo "          <a class='size-28 bold no-link-style' href='https://example.com'>" . htmlspecialchars(strtoupper($libro->get_titulo())) . "</a>";
                echo "          <p class='size-20 low-margin-v'>" . htmlspecialchars($libro->get_autor()) . "</p>";
                echo "          <p>" . number_format($libro->get_precio(), 2) . "€ </p>";
                echo "      </div>";
                echo "  </div>";

                
                echo "</div>";
            }
            echo "</div>";
        }else{
            echo "No hay resultados de esta busqueda :(";
        }

    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WANNABOOK</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="navbar">
        <button href="./" class="nav-btn raleway-regular">WANNABOOK</button>
    </div>

    <div class="section first-section">
        <div class="align-center d-flex">
            <p class="vertical-text" >Más vendidos</p>
            <a class="vertical-text" href="./">Ver más</a>
        </div>
        <hr>
        <?php mostrar_libros('descarga');?>
    </div>
    <div>
        
        <h2>Libros mas recientes</h2>
        <?php mostrar_libros('fecha');?>
    </div>
        
        
    
</body>
</html>
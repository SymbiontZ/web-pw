<?php
    include('src/clases.php');

    define('IMAGEN_DIR', './data');

    function mostrar_libros($orden){
        /** @var Libro[] $lista */
        $lista = [];

        switch ($orden) {
            case 'descarga':
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
            foreach ($lista as $libro) {
                echo "<div class='product-container'>";
                echo "<img src='./data/". $libro->get_url()."' width='200' style='margin:5px;'><br>";
                echo "<hr>";
                echo "<h3>" . htmlspecialchars($libro->get_titulo()) . "</h3>";
                echo "<p>Autor: " . htmlspecialchars($libro->get_autor()) . "</p>";
                echo "<p>Precio: $" . number_format($libro->get_precio(), 2) . "</p>";

                echo "</div>";
            }
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
        <button class="nav-btn raleway-regular">WANNABOOK</button>
    </div>
    <br/>
    <br/>

    <div id="section">
        Mas vendidos
        <a href="./">Ver más</a>
        <hr>
    </div>
    <div>
        <?php mostrar_libros('descarga');?>
        <h2>Libros mas recientes</h2>
        <?php mostrar_libros('fecha');?>
    </div>
        
        
    
</body>
</html>
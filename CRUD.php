<?php
    include('clases.php');
    try{
        $base = new PDO('mysql:host=localhost;dbname=tienda_libros', 'librero', 'KMqvxADpnKSsDEOe');
        $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Conexion exitosa<br><br>";

        //Inserción de datos
        //$insercion = $base->exec("INSERT INTO libros (titulo, autor, paginas, fecha_pub) VALUES ('La historia interminable', 'Michael Ende', '400', '1979-01-01')");
        //echo "Insercion exitosa<br><br>";

        //Lectura de datos
        $sql = "SELECT titulo, autor, precio, paginas, fecha, imagen, GROUP_CONCAT(c.categoria) AS categorias
                FROM libros l
                LEFT JOIN libros_categorias lc ON l.id_libro = lc.id_libro
                LEFT JOIN categorias c ON lc.id_categoria = c.id_categoria
                GROUP BY l.id_libro";
        $stmt = $base->prepare($sql);
        $stmt->execute();

        $libros = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $categorias = explode(',', $row['categorias']);     // Convierte la lista de categorías en un array
            $libro = new Libro(
                $row['titulo'],
                $row['autor'],
                $row['precio'],
                $row['paginas'],
                $row['fecha'],
                $row['imagen'],
                $categorias
            );
            $libros[] = $libro;
        }
        //Mostramos los objetos
        foreach($libros as $libro)
        {
            echo "Titulo: ".$libro->get_titulo()."<br>"." Autor: ".$libro->get_autor()."<br>"." Precio: ".$libro->get_precio()."<br>"." Paginas: ".$libro->get_numPags()."<br>"." Fecha de publicacion: "."<br>".$libro->get_fecha()."<br>"." Categoria: ".implode(',',$libro->get_categorias())."<br><br>";
        }

        //Eliminación de datos
        //$eliminacion = $base->exec("DELETE FROM libros WHERE titulo = 'La historia interminable'");
        //echo "Eliminacion exitosa<br><br>";

        //Actualización de datos
        //$actualizacion = $base->exec("UPDATE libros SET paginas = '1200' WHERE titulo = 'El señor de los anillos'");
        //echo "Actualizacion exitosa<br><br>";

        //Mostrar fotos de la base de datos
        $imagen = $base->query("SELECT imagen FROM libros");
        while($datos = $imagen->fetch())
        {
            echo "<img src='./data/".$datos['imagen']."' width='300' style='margin:10px;'><br>";
        }

    }catch(Exception $e){
        die('Error: ' . $e->GetMessage());
    }finally{
        $base = null;   //Cierre de la conexion
    }
?>

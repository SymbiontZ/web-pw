<?php
    try{
        $base = new PDO('mysql:host=localhost;dbname=tienda_libros', 'librero', 'KMqvxADpnKSsDEOe');
        $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Conexion exitosa<br><br>";

        //Lectura de datos
        $lectura = $base->query('SELECT titulo, autor, paginas, fecha_pub FROM libros');
        while($datos = $lectura->fetch())
        {
            echo "Titulo: " . $datos['titulo'] . " Autor: " . $datos['autor'] . " Paginas: " . $datos['paginas'] . " Fecha de publicacion: " . $datos['fecha_pub'] . "<br><br>";
        }

        //Inserción de datos
        //$insercion = $base->exec("INSERT INTO libros (categoria, titulo, autor, paginas, fecha_pub) VALUES ('2','El señor de los anillos', 'J.R.R. Tolkien', '1200', '1954-07-29')");
        //echo "Insercion exitosa<br><br>";

        //Eliminación de datos
        //$eliminacion = $base->exec("DELETE FROM libros WHERE titulo = 'La asistenta'");
        //echo "Eliminacion exitosa<br><br>";

        //Actualización de datos
        //$actualizacion = $base->exec("UPDATE libros SET paginas = '1200' WHERE titulo = 'El señor de los anillos'");
        //echo "Actualizacion exitosa<br><br>";

        //Mostrar fotos de la base de datos
        $imagen = $base->query("SELECT imagen FROM libros");
        while($datos = $imagen->fetch())
        {
            echo "<img src='http://localhost/pw/".$datos['imagen']."' width='300' style='margin:10px;'><br>";
        }

    }catch(Exception $e){
        die('Error: ' . $e->GetMessage());
    }finally{
        $base = null;   //Cierre de la conexion
    }
?>

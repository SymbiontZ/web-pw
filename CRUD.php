<?php
    try{
        $base = new PDO('mysql:host=localhost;dbname=tienda_libros', 'librero', 'KMqvxADpnKSsDEOe');
        $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Conexion exitosa<br><br>";

        $resultado = $base->query('SELECT titulo, autor, paginas, fecha_pub FROM libros');
        while($datos = $resultado->fetch())
        {
            echo "Titulo: " . $datos['titulo'] . " Autor: " . $datos['autor'] . " Paginas: " . $datos['paginas'] . " Fecha de publicacion: " . $datos['fecha_pub'] . "<br><br>";
        }
    }catch(Exception $e){
        die('Error: ' . $e->GetMessage());
    }finally{
        $base = null;   //Cierre de la conexion
    }
?>
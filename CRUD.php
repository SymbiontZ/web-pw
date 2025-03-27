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
        $sql= "SELECT * FROM Libros";
        $stmt = $base->prepare($sql);
        $stmt->execute();

        $libros = $stmt->fetchAll(PDO::FETCH_CLASS, 'Libro');
        //Mostramos los objetos
        foreach($libros as $libro)
        {
            echo "Titulo: ".$libro['titulo']."Autor: ".$libro['autor']."Paginas: ".$libro['paginas']."Fecha de publicacion: ".$libro['fecha_pub']."<br>";
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

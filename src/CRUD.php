<?php
    include('./src/clases.php');

    function conectar()
    {
        try{
            $base = new PDO('mysql:host=localhost;dbname=libreria', 'librero', 'KMqvxADpnKSsDEOe');
            $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $base;

        }catch(Exception $e){
            echo "Error: " . $e->GetMessage() . "<br>";
            die('Error: ' . $e->GetMessage());

        }finally{
            $base = null;   //Cierre de la conexion
        }
    }
    
    function devolverLibros(): array
    {
        $sql = "SELECT l.id_libro, l.titulo, l.autor, l.precio, l.paginas, l.fecha, l.imagen, l.sinopsis, l.editorial, GROUP_CONCAT(c.categoria) AS categorias
            FROM libros l
            LEFT JOIN libros_categorias lc ON l.id_libro = lc.id_libro
            LEFT JOIN categorias c ON lc.id_categoria = c.id_categoria
            GROUP BY l.id_libro";
        $base = conectar(); // Conexión a la base de datos
        if (!$base) {
            return []; // Retorna un array vacío si no se pudo conectar
        }
        $stmt = $base->prepare($sql);
        $stmt->execute();

        $libros = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $categorias = explode(',', $row['categorias']);     // Convierte la lista de categorías en un array
            $libro = new Libro(
                $row['id_libro'],
                $row['titulo'],
                $row['autor'],
                $row['precio'],
                $row['paginas'],
                $row['fecha'],
                $row['imagen'],
                $categorias,
                $row['sinopsis'],
                $row['editorial']
            );
            $libros[] = $libro;
        }

        return $libros;
    }

    function obtenerLibroPorId($id_libro)
    {
        $sql = "SELECT l.id_libro, l.titulo, l.autor, l.precio, l.paginas, l.fecha, l.imagen, l.sinopsis, l.editorial, GROUP_CONCAT(c.categoria) AS categorias
            FROM libros l
            LEFT JOIN libros_categorias lc ON l.id_libro = lc.id_libro
            LEFT JOIN categorias c ON lc.id_categoria = c.id_categoria
            WHERE l.id_libro = $id_libro
            GROUP BY l.id_libro";
        $base = conectar(); // Conexión a la base de datos
        if (!$base) {
            return []; // Retorna un array vacío si no se pudo conectar
        }
        $stmt = $base->prepare($sql);
        $stmt->execute();

        if($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $categorias = explode(',', $row['categorias']);     // Convierte la lista de categorías en un array
            return new Libro(
                $row['id_libro'],
                $row['titulo'],
                $row['autor'],
                $row['precio'],
                $row['paginas'],
                $row['fecha'],
                $row['imagen'],
                $categorias,
                $row['sinopsis'],
                $row['editorial']
            );
        }
        return null;
    }

?>
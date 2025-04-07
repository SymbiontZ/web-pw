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
    
    function devolverLibrosFecha(): array
    {
        $sql = "SELECT l.id_libro, l.titulo, l.autor, l.precio, l.paginas, l.fecha, l.imagen, l.sinopsis, l.editorial, GROUP_CONCAT(c.categoria) AS categorias
            FROM libros l
            LEFT JOIN libros_categorias lc ON l.id_libro = lc.id_libro
            LEFT JOIN categorias c ON lc.id_categoria = c.id_categoria
            LEFT JOIN compras co ON l.id_libro = co.id_libro
            WHERE l.disponible
            GROUP BY l.id_libro
            ORDER BY l.fecha DESC"; // Cambia el orden a descendente
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

    function devolverLibrosDescarga(): array
    {
        $sql = "SELECT l.id_libro, l.titulo, l.autor, l.precio, l.paginas, l.fecha, l.imagen, l.sinopsis, l.editorial, GROUP_CONCAT(c.categoria) AS categorias, COUNT(co.id_libro) AS ventas
            FROM libros l
            LEFT JOIN libros_categorias lc ON l.id_libro = lc.id_libro
            LEFT JOIN categorias c ON lc.id_categoria = c.id_categoria
            LEFT JOIN compras co ON l.id_libro = co.id_libro
            LEFT JOIN usuarios u ON co.id_usuario = u.id
            WHERE l.disponible = 1 AND u.esActivo = 1
            GROUP BY l.id_libro = :id_libro
            ORDER BY ventas DESC";
        $base = conectar(); // Conexión a la base de datos
        if (!$base) {
            return []; // Retorna un array vacío si no se pudo conectar
        }
        $stmt = $base->prepare($sql);
        $stmt->bindParam(':id_libro', $id_libro, PDO::PARAM_INT);
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

    function devolverLibrosAlfabeto(): array
    {
        $sql = "SELECT l.id_libro, l.titulo, l.autor, l.precio, l.paginas, l.fecha, l.imagen, l.sinopsis, l.editorial, l.disponible = 1, GROUP_CONCAT(c.categoria) AS categorias
            FROM libros l
            LEFT JOIN libros_categorias lc ON l.id_libro = lc.id_libro
            LEFT JOIN categorias c ON lc.id_categoria = c.id_categoria
            LEFT JOIN compras co ON l.id_libro = co.id_libro
            WHERE l.disponible = 1
            GROUP BY l.id_libro = :id_libro
            ORDER BY l.titulo ASC";
        $base = conectar(); // Conexión a la base de datos
        if (!$base) {
            return []; // Retorna un array vacío si no se pudo conectar
        }
        $stmt = $base->prepare($sql);
        $stmt->bindParam(':id_libro', $id_libro, PDO::PARAM_INT);
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

    function obtenerLibroPorId($id_libro) {
        $sql = "SELECT 
                    l.id_libro, 
                    l.titulo, 
                    l.autor, 
                    l.precio, 
                    l.paginas, 
                    l.fecha, 
                    l.imagen, 
                    l.sinopsis, 
                    l.editorial, 
                    GROUP_CONCAT(c.categoria) AS categorias
                FROM libros l
                LEFT JOIN libros_categorias lc ON l.id_libro = lc.id_libro
                LEFT JOIN categorias c ON lc.id_categoria = c.id_categoria
                WHERE l.disponible = 1 
                    AND l.id_libro = :id_libro
                GROUP BY l.id_libro";
    
        $base = conectar();
        if (!$base) {
            return null;
        }
        
        $stmt = $base->prepare($sql);
        $stmt->bindParam(':id_libro', $id_libro, PDO::PARAM_INT);
        $stmt->execute();
    
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $categorias = explode(',', $row['categorias']);
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

    function obtenerLibroPorAutor($autor)
    {
        $sql = "SELECT l.id_libro, l.titulo, l.autor, l.precio, l.paginas, l.fecha, l.imagen, l.sinopsis, l.editorial, GROUP_CONCAT(c.categoria) AS categorias
            FROM libros l
            LEFT JOIN libros_categorias lc ON l.id_libro = lc.id_libro
            LEFT JOIN categorias c ON lc.id_categoria = c.id_categoria
            LEFT JOIN compras co ON l.id_libro = co.id_libro
            LEFT JOIN usuarios u ON co.id_usuario = u.id
            WHERE l.disponible = 1 AND u.esActivo = 1 AND l.autor = :autor
            GROUP BY l.id_libro";
        $base = conectar(); // Conexión a la base de datos
        if (!$base) {
            return []; // Retorna un array vacío si no se pudo conectar
        }
        $stmt = $base->prepare($sql);
        $stmt->bindParam(':autor', $autor, PDO::PARAM_INT);
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

    function registrarCompra(int $id_libro, int $id_usuario): void {
        $base = conectar();
        if (!$base) return;
    
        $sql = "INSERT INTO compras (id_libro, id_usuario, fecha) VALUES (:id_libro, :id_usuario, NOW())";
        $stmt = $base->prepare($sql);
        $stmt->bindParam(':id_libro', $id_libro, PDO::PARAM_INT);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();
    }

?>
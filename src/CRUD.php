<?php
    include(__DIR__ . '/clases.php');

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
        $sql = "SELECT l.id_libro, l.titulo, l.autor, l.precio, l.paginas, l.fecha, l.imagen, l.sinopsis, l.editorial, GROUP_CONCAT(c.categoria) AS categorias, l.disponible
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
                $row['editorial'],
                (bool)$row['disponible']
            );
            $libros[] = $libro;
        }

        return $libros;
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
            GROUP BY l.id_libro
            ORDER BY ventas DESC";
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

    function devolverLibrosAlfabeto(): array
    {
        $sql = "SELECT l.id_libro, l.titulo, l.autor, l.precio, l.paginas, l.fecha, l.imagen, l.sinopsis, l.editorial, l.disponible, GROUP_CONCAT(c.categoria) AS categorias
            FROM libros l
            LEFT JOIN libros_categorias lc ON l.id_libro = lc.id_libro
            LEFT JOIN categorias c ON lc.id_categoria = c.id_categoria
            LEFT JOIN compras co ON l.id_libro = co.id_libro
            WHERE l.disponible = 1
            GROUP BY l.id_libro
            ORDER BY l.titulo ASC";
        $base = conectar(); // Conexión a la base de datos
        if (!$base) {
            return []; // Retorna un array vacío si no se pudo conectar
        }
        $stmt = $base->prepare($sql);
        $stmt->execute();

        $libros = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $categorias = explode(',', $row['categorias']);
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
                $row['editorial'],
                (bool)$row['disponible']
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
            LEFT JOIN compras co ON l.id_libro = co.id_libro
            LEFT JOIN usuarios u ON co.id_usuario = u.id
            WHERE l.disponible = 1 AND u.esActivo = 1 AND l.id_libro = :id_libro
            GROUP BY l.id_libro";
        $base = conectar(); // Conexión a la base de datos
        if (!$base) {
            return []; // Retorna un array vacío si no se pudo conectar
        }
        $stmt = $base->prepare($sql);
        $stmt->bindParam(':id_libro', $id_libro, PDO::PARAM_INT);
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

    function buscarLibros($busqueda): array
    {
        $sql = "SELECT l.id_libro, l.titulo, l.autor, l.precio, l.paginas, l.fecha, l.imagen, l.sinopsis, l.editorial, GROUP_CONCAT(c.categoria) AS categorias
            FROM libros l
            LEFT JOIN libros_categorias lc ON l.id_libro = lc.id_libro
            LEFT JOIN categorias c ON lc.id_categoria = c.id_categoria
            WHERE (l.titulo LIKE :busqueda OR l.autor LIKE :busqueda OR l.editorial LIKE :busqueda) AND l.disponible = 1
            GROUP BY l.id_libro";
        $base = conectar(); // Conexión a la base de datos
        if (!$base) {
            return []; // Retorna un array vacío si no se pudo conectar
        }
        $stmt = $base->prepare($sql);
        $busqueda_param = '%' . $busqueda . '%';
        $stmt->bindParam(':busqueda', $busqueda_param, PDO::PARAM_STR);
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

    function cambiarEstadoLibro($id_libro, $estado): void
    {
        $sql = "UPDATE libros SET disponible = :estado WHERE id_libro = :id_libro";
        $base = conectar(); // Conexión a la base de datos
        if (!$base) return;

        $stmt = $base->prepare($sql);
        $stmt->bindParam(':estado', $estado, PDO::PARAM_INT);
        $stmt->bindParam(':id_libro', $id_libro, PDO::PARAM_INT);
        $stmt->execute();
    }

    function registrarCompra(int $id_libro, int $id_usuario, int $cantidad): void {
        $base = conectar();
        if (!$base) return;
    
        $sql = "INSERT INTO compras (id_libro, id_usuario, fecha, cantidad) VALUES (:id_libro, :id_usuario, NOW(), :cantidad)";
        $stmt = $base->prepare($sql);
        $stmt->bindParam(':id_libro', $id_libro, PDO::PARAM_INT);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
        $stmt->execute();
    }

    /*** USERS ***/

    function isAdmin($nombre): bool
    {
        $sql = "SELECT Administrador FROM usuarios WHERE Usuario = :usuario";
        $base = conectar(); // Conexión a la base de datos
        if (!$base) {
            return false; // Retorna false si no se pudo conectar
        }
        $stmt = $base->prepare($sql);
        $stmt->bindParam(':usuario', $nombre, PDO::PARAM_STR);
        $stmt->execute();

        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return (bool)$row['Administrador'];
        }
        return false;
    }
    function devolverIdPorNombre($nombre): ?int
    {
        $sql = "SELECT id FROM usuarios WHERE Usuario = :usuario";
        $base = conectar(); // Conexión a la base de datos
        if (!$base) {
            return null; // Retorna null si no se pudo conectar
        }
        $stmt = $base->prepare($sql);
        $stmt->bindParam(':usuario', $nombre, PDO::PARAM_STR);
        $stmt->execute();

        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return (int)$row['id'];
        }
        return null;
    }

    function devolverUsuariosCorrientes(): array
    {
        $sql = "SELECT id, Usuario, esActivo FROM usuarios WHERE Administrador = 0";
        $base = conectar();
        if (!$base) {
            return [];
        }
        $stmt = $base->prepare($sql);
        $stmt->execute();

        $usuarios = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $usuarios[] = [
                'id' => $row['id'],
                'usuario' => $row['Usuario'],
                'esActivo' => (bool)$row['esActivo']
            ];
        }

        return $usuarios;
    }

    function cambiarEstadoUsuario($id_usuario, $estado): void
    {
        $sql = "UPDATE usuarios SET esActivo = :estado WHERE id = :id_usuario";
        $base = conectar();
        if (!$base) return;

        $stmt = $base->prepare($sql);
        $stmt->bindParam(':estado', $estado, PDO::PARAM_INT);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();
    }
?>
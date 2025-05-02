<!-- resources/views/productos.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Lista de Productos</title>
</head>
<body>
    <h1>Productos</h1>
    <ul>
        @foreach ($productos as $producto)
            <li>{{ $producto->nombre }}</li>
        @endforeach
    </ul>
</body>
</html>
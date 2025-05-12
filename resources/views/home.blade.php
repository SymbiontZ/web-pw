<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WANNABOOK | Inicio </title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    @vite('resources/css/style.css')
</head>
<body>
    <x-navbar />
    <div style="margin-top: 80px;"></div>
    <x-book-list :titulo="'Más vendidos'" :libros="$libroOrdCompras" :orden="'compraAsc'"/> 
    <x-book-list :titulo="'Más recientes'" :libros="$libroOrdFecha" :orden="'fechaAsc'"/>
    <x-book-list :titulo="'De la A-Z'" :libros="$libroOrdAbc" :orden="'abcAsc'"/>

    <a href="#" 
    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
    class="text-red-500 hover:underline">
    Cerrar sesión
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    
</body>
</html>


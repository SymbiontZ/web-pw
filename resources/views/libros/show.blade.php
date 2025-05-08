<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> {{ $libro->titulo }} - {{ $libro->autor }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    @vite('resources/css/style.css')
</head>
<body>
    <x-navbar />
        <div class="book-container d-flex align-center justify-center max-w color-1" style="margin-top: 60px; margin-left: 20px; display: flex; flex-wrap: wrap;">
            <div style="flex: 1; max-width: 25%; padding: 10px;">
                <img src="{{ asset('images/' . $libro->imagen) }}" alt="{{ $libro->titulo }} - {{ $libro->autor }}" class="max-w border-rounded shadow">
            </div>
            <div class="book-info" style="flex: 1; max-width: 60%; padding: 10px;">
                <h1 class="section-title"> {{ $libro->titulo }}</h1>
                <p><strong>Autor:</strong> {{ $libro->autor }}</p>
                <p><strong>Precio:</strong> {{ number_format($libro->precio, 2) }}€ </p>
                <p><strong>Editorial:</strong> {{ $libro->editorial }} </p>
                <p><strong>Sinopsis:</strong> {{ $libro->sinopsis }} </p>
                <p><strong>Categorias: </strong> {{ $libro->categorias }}</p>
                <!-- <form method="post" action="">
                    <input type="hidden" name="id_libro" value="' . htmlspecialchars($libro->get_id(), ENT_QUOTES, 'UTF-8') . '">
                    <button type="submit" name="añadir" class="color-3 book-cart-btn">
                        <i class="fas fa-cart-plus icon" style="color: white;"></i>
                    </button>
                </form> -->
            </div>
        </div>
        
</body>
</html>
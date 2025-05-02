<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> {{ $busqueda }} en WANNABOOK</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    @vite('resources/css/style.css')
</head>
<body>
    <x-navbar />
    <div style="margin-top: 80px; padding: 0 20px;">
        <h1>Resultados de la búsqueda para '{{ $busqueda }}' </h1>
        @if(count($libros)>0)
        <div class="product-grid">
            @foreach ($libros as $libro)
                <div class="product-container justify-center max-w color-1">
                    <a href="{{ route('libros.show', ['id' => $libro->id_libro]) }}">
                        <img class="justify-center d-flex max-w"
                            src="{{ asset('images/' . $libro->imagen) }}"
                            alt="{{ $libro->titulo }} - {{ $libro->autor }}">
                    </a>
                    <hr>
                    <div>
                        <a class="size-18 bold black-text no-link-style text-multiline-truncate"
                        href="/libro/{{ $libro->id_libro }}">
                            {{ strtoupper($libro->titulo) }}
                        </a>
                        <p class="size-14 low-margin-v">{{ $libro->autor }}</p>
                        <p class="size-16 bold text-right mt-20 mb-5    ">
                            {{ number_format($libro->precio, 2) }}€
                        </p>
                        <form method="POST" action="/">
                            @csrf
                            <input type="hidden" name="id_libro" value="{{ $libro->id }}">
                            <button type="submit" name="añadir" class="hover-btn jetbrains-mono-regular color-3">
                                <i class="fas fa-cart-plus icon"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
        @else
        <p>No se encontraron resultados.</p>
        @endif
    </div>
</body>
</html>
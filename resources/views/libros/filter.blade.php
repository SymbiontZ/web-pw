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

    <div style="margin-top: 80px; padding: 0 20px;"">
        <form method="GET" action="{{ route('libros.index') }}" class="filtros-form">
            <input type="hidden" name="busqueda" value="{{ request('busqueda') }}">
            
            <label for="orden"><strong>Ordenar por</strong></label>
            <select name="orden" id="orden">
                <option value="">-- Selecciona --</option>
                <option value="abcAsc" {{ request('orden') == 'abcAsc' ? 'selected' : '' }}>Nombre (A-Z)</option>
                <option value="abcDesc" {{ request('orden') == 'abcDesc' ? 'selected' : '' }}>Nombre (Z-A)</option>
                <option value="fechaAsc" {{ request('orden') == 'fechaAsc' ? 'selected' : '' }}>Más recientes</option>
                <option value="fechaDesc" {{ request('orden') == 'fechaDesc' ? 'selected' : '' }}>Más antiguos</option>
                <option value="precioAsc" {{ request('orden') == 'precioAsc' ? 'selected' : '' }}>Precio (menor a mayor)</option>
                <option value="precioDesc" {{ request('orden') == 'precioDesc' ? 'selected' : '' }}>Precio (mayor a menor)</option>
                <option value="comprasAsc" {{ request('orden') == 'comprasAsc' ? 'selected' : '' }}>Más vendidos</option>
                <option value="comprasDesc" {{ request('orden') == 'comprasDesc' ? 'selected' : '' }}>Menos vendidos</option>
            </select>

            <button type="submit" class="filter-btn color-3">Aplicar filtros</button>
        </form>
    </div>
    <div style="margin-top: 20px; padding: 0 20px;">
        @if($busqueda)
            <h1>Resultados de la búsqueda para '{{ $busqueda }}' </h1>
        @else
            <h1>Resultados de la búsqueda</h1>
        @endif
        @if(count($libros)>0)
        <div class="product-grid">
            @foreach ($libros as $libro)
                <div class="product-container justify-center max-w color-1">
                    <a href="{{ route('libros.show', ['id' => $libro->id_libro]) }}">
                        <img class="justify-center d-flex max-w"
                            src="{{ asset('images/' . $libro->imagen) }}"
                            alt="{{ $libro->titulo }} - {{ $libro->autor->nombre }}">
                    </a>
                    <hr>
                    <div>
                        <a class="size-18 bold black-text no-link-style text-multiline-truncate"
                        href="/libro/{{ $libro->id_libro }}">
                            {{ strtoupper($libro->titulo) }}
                        </a>
                        <p class="size-14 low-margin-v">{{ $libro->autor->nombre }}</p>
                        <p class="size-16 bold text-right mt-20 mb-5    ">
                            {{ number_format($libro->precio, 2) }}€
                        </p>
                        <form method="POST" action="{{ route('carro.agregar') }}">
                            @csrf
                            <input type="hidden" name="producto[id]" value="{{ $libro->id_libro }}">
                            <input type="hidden" name="producto[titulo]" value="{{ $libro->titulo }}">
                            <input type="hidden" name="producto[autor]" value="{{ $libro->autor->nombre }}">
                            <input type="hidden" name="producto[precio]" value="{{ $libro->precio }}">
                            <input type="hidden" name="producto[portada]" value="{{ $libro->imagen }}">
                            <button type="submit" class="hover-btn color-3">
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
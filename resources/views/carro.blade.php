<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WANNABOOK | Carro</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    @vite('resources/css/style.css')
</head>
<body>
    <x-navbar />
    <div style="margin-top: 80px; padding: 0 20px;">
        <div class="carro-container" style="max-width: 800px; margin: 0 auto; background: #f9f9f9; padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
            <h2 style="text-align: center; margin-bottom: 20px;">Tu Carrito</h2>
            
            @if(session('cart') && count(session('cart')) > 0)
                @foreach(session('cart') as $producto)
                    <div class="producto-item" style="display: flex; align-items: center; margin-bottom: 20px; border-bottom: 1px solid #ddd; padding-bottom: 10px;">
                        <img src="{{ asset('images/' . $producto['portada']) }}" alt="Portada" style="width: 80px; height: 100px; object-fit: cover; margin-right: 20px;">
                        <div style="flex: 1;">
                            <a href="{{ route('libros.show', ['id' => $producto['id']]) }}" class="color-f-3" style="text-decoration: none; font-weight: bold;">
                                {{ $producto['titulo'] }} - {{ number_format($producto['precio'], 2) }}€
                            </a>
                            <p style="margin: 5px 0;">{{ $producto['autor'] }}</p>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <form method="POST" action="{{ route('carro.eliminar') }}" style="display: inline;">
                                    @csrf
                                    <input type="hidden" name="producto_id" value="{{ $producto['id'] }}">
                                    <button type="submit" class="color-f-3 cart-delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('carro.agregar') }}" style="display: inline;">
                                    @csrf
                                    <input type="hidden" name="producto[id]" value="{{ $producto['id'] }}">
                                    <input type="hidden" name="producto[titulo]" value="{{ $producto['titulo'] }}">
                                    <input type="hidden" name="producto[autor]" value="{{ $producto['autor'] }}">
                                    <input type="hidden" name="producto[portada]" value="{{ $producto['portada'] }}">
                                    <button type="submit" class="color-f-3 cart-add">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </form>
                                <span style="font-weight: bold;">Cantidad: {{ $producto['cantidad'] }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div style="text-align: center; margin-top: 20px;">
                    <form method="POST" action="{{ route('carro.vaciar') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="cart-btn color-3">
                            Vaciar Carrito
                        </button>
                    </form>
                    <form method="POST" action="{{ route('carro.completar') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="cart-btn color-4">
                            Completar Compra
                        </button>
                    </form>
                </div>
            @else
                <p class="text-center color-f-3">Tu carrito está vacío.</p>
            @endif
        </div>
    </div>
</body>
</html>
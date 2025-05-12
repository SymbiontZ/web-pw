<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WANNABOOK | Perfil </title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    @vite('resources/css/style.css')
</head>
<body>
    <x-navbar />
    <div style="margin-top: 80px; padding: 0 20px;">
        <div class="perfil-container" style="max-width: 1000px; margin: 0 auto; background: #f9f9f9; padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
            <h2 class="text-center"style="margin-bottom: 20px;">
                Perfil de Usuario
                <i class="fas fa-user-circle" style="font-size: 24px; margin-left: 10px;"></i>
            </h2>
            
            <div style="margin-bottom: 20px;">
                <p><strong>Nombre:</strong> {{ $usuario->nombre }}</p>
                <p><strong>Email:</strong> {{ $usuario->email }}</p>
            </div>

            <h3 class="text-center" style="margin-bottom: 10px;">
                Tus Compras Recientes
                <i class="fas fa-shopping-cart" style="font-size: 24px; margin-left: 10px;"></i>
            </h3>
            @if($compras->isEmpty())
                <p>No has realizado ninguna compra aún.</p>
            @else
                @foreach($compras as $compra)
                    <div class="compra-item" style="margin-bottom: 10px;">
                        <p><strong>{{ $compra->libro->titulo }}</strong>, {{ $compra->libro->autor->nombre }} <strong>x{{ $compra->cantidad }}</strong> - {{ number_format($compra->libro->precio, 2) }}€ - {{ $compra->fecha->format('d/m/Y') }}</p>
                    </div>
                @endforeach
            @endif
        </div>
    
</body>
</html>
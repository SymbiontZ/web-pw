<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WANNABOOK | Perfil Autor</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    @vite('resources/css/style.css')
</head>
<body>
    <x-navbar />
    <div style="margin-top: 80px; padding: 0 20px;">
        <div class="perfil-container" style="max-width: 1000px; margin: 0 auto; background: #f9f9f9; padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
            <h2 class="text-center" style="margin-bottom: 20px;">
                Perfil del Autor
                <i class="fas fa-user-circle" style="font-size: 24px; margin-left: 10px;"></i>
            </h2>
            
            <div style="margin-bottom: 20px;">
                <p><strong>Nombre:</strong> {{ $autor->nombre }}</p>
                <p><strong>Descripcion</strong></p>
                <p>{{ $autor->descripcion }}</p>
            </div>

            <h3 class="text-center" style="margin-bottom: 10px;">
                Tus Libros Publicados
                <i class="fas fa-book" style="font-size: 24px; margin-left: 10px;"></i>
            </h3>
            @if($libros->isEmpty())
                <p>No has publicado ningún libro aún.</p>
            @else
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th style="border-bottom: 1px solid #ddd; padding: 8px;">Título</th>
                            <th style="border-bottom: 1px solid #ddd; padding: 8px;">Precio</th>
                            <th style="border-bottom: 1px solid #ddd; padding: 8px;">Disponibilidad</th>
                            <th style="border-bottom: 1px solid #ddd; padding: 8px;">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($libros as $libro)
                            <tr>
                                <td style="border-bottom: 1px solid #ddd; padding: 8px;">{{ $libro->titulo }}</td>
                                <td style="border-bottom: 1px solid #ddd; padding: 8px;">{{ number_format($libro->precio, 2) }}€</td>
                                <td style="border-bottom: 1px solid #ddd; padding: 8px;">
                                    {{ $libro->disponible ? 'Disponible' : 'No Disponible' }}
                                </td>
                                <td style="border-bottom: 1px solid #ddd; padding: 8px;">
                                    <form method="POST" action="{{ route('libros.toggle', ['id' => $libro->id_libro]) }}">
                                        @csrf
                                        <button type="submit" class="btn" style="background-color: {{ $libro->disponible ? '#5f1854' : '#1abb9c' }}; color: white; border: none; padding: 8px 16px; border-radius: 4px; cursor: pointer;">
                                            {{ $libro->disponible ? 'No Mostrar' : 'Mostrar' }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</body>
</html>
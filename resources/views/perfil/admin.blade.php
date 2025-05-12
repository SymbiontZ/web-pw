<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WANNABOOK | Perfil Admin</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    @vite('resources/css/style.css')
</head>
<body>
    <x-navbar />
    <div style="margin-top: 80px; padding: 0 20px;">
        <div class="perfil-container" style="max-width: 1000px; margin: 0 auto; background: #f9f9f9; padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
            <h2 class="text-center" style="margin-bottom: 20px;">
                Panel de Administrador
                <i class="fas fa-user-shield" style="font-size: 24px; margin-left: 10px;"></i>
            </h2>

            {{-- Sección de Compras --}}
            <h3 class="text-center" style="margin-bottom: 10px;">
                Compras Realizadas
                <i class="fas fa-shopping-cart" style="font-size: 24px; margin-left: 10px;"></i>
            </h3>
            @if($compras->isEmpty())
                <p>No se han realizado compras aún.</p>
            @else
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th style="border-bottom: 1px solid #ddd; padding: 8px;">Usuario</th>
                            <th style="border-bottom: 1px solid #ddd; padding: 8px;">Libro</th>
                            <th style="border-bottom: 1px solid #ddd; padding: 8px;">Cantidad</th>
                            <th style="border-bottom: 1px solid #ddd; padding: 8px;">Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($compras as $compra)
                            <tr>
                                <td style="border-bottom: 1px solid #ddd; padding: 8px;">{{ $compra->usuario->nombre }}</td>
                                <td style="border-bottom: 1px solid #ddd; padding: 8px;">{{ $compra->libro->titulo }}</td>
                                <td style="border-bottom: 1px solid #ddd; padding: 8px;">{{ $compra->cantidad }}</td>
                                <td style="border-bottom: 1px solid #ddd; padding: 8px;">{{ $compra->fecha->format('d/m/Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

            {{-- Sección de Libros --}}
            <h3 class="text-center" style="margin-bottom: 10px;">
                Gestión de Libros
                <i class="fas fa-book" style="font-size: 24px; margin-left: 10px;"></i>
            </h3>
            @if($libros->isEmpty())
                <p>No hay libros disponibles.</p>
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

            {{-- Sección de Usuarios --}}
            <h3 class="text-center" style="margin-bottom: 10px;">
                Gestión de Usuarios
                <i class="fas fa-users" style="font-size: 24px; margin-left: 10px;"></i>
            </h3>
            @if($usuarios->isEmpty())
                <p>No hay usuarios registrados.</p>
            @else
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th style="border-bottom: 1px solid #ddd; padding: 8px;">Nombre</th>
                            <th style="border-bottom: 1px solid #ddd; padding: 8px;">Email</th>
                            <th style="border-bottom: 1px solid #ddd; padding: 8px;">Estado</th>
                            <th style="border-bottom: 1px solid #ddd; padding: 8px;">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($usuarios as $usuario)
                            <tr>
                                <td style="border-bottom: 1px solid #ddd; padding: 8px;">{{ $usuario->nombre }}</td>
                                <td style="border-bottom: 1px solid #ddd; padding: 8px;">{{ $usuario->email }}</td>
                                <td style="border-bottom: 1px solid #ddd; padding: 8px;">
                                    {{ $usuario->esActivo ? 'Habilitado' : 'Deshabilitado' }}
                                </td>
                                <td style="border-bottom: 1px solid #ddd; padding: 8px;">
                                    <form method="POST" action="{{ route('usuarios.toggle', ['id' => $usuario->id]) }}">
                                        @csrf
                                        <button type="submit" class="btn" style="background-color: {{ $usuario->esActivo ? '#5f1854' : '#1abb9c' }}; color: white; border: none; padding: 8px 16px; border-radius: 4px; cursor: pointer;">
                                            {{ $usuario->esActivo ? 'Deshabilitar' : 'Habilitar' }}
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
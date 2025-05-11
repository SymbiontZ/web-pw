@props(['type' => 'default'])

<div class="navbar color-4 d-flex align-center justify-between">
    <div class="nav-left">
        <a href="/" class="nav-btn raleway-regular color-4 no-link-style">WANNABOOK</a>
    </div>

    @if($type === 'home')
    <div class="nav-center">
        <form method="GET" action="{{ route('libros.index') }}">
            <input type="text" name="busqueda" placeholder="Buscar..." 
                   class="search-input" required>
            <button type="submit" class="search-btn color-4">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>
    @endif

    <div class="nav-right">
        @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">Cerrar sesión</button>
            </form>
        @else
            @if($type !== 'auth')
                <a href="{{ route('login') }}" class="nav-action-btn">Iniciar sesión</a>
                <a href="{{ route('register') }}" class="nav-action-btn">Registrarse</a>
            @endif
        @endauth
    </div>
</div>

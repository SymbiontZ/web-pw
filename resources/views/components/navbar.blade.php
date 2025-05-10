<div class="navbar navbar-{{ $type }} color-4 d-flex align-center justify-between">
    <div class="nav-left">
        <a href="/" class="nav-btn raleway-regular color-4 no-link-style">WANNABOOK</a>
    </div>

    @if($type === 'home')
    <div class="nav-center">
        <form method="GET" action="{{ route('libros.index') }}" onsubmit="return validarBusqueda()">
            <input type="text" name="busqueda" placeholder="Buscar por título, autor..." id="busquedaInput" class="search-input">
                <button type="submit" class="search-btn color-4">
                    <i class="fas fa-search"></i>
                </button>
        </form>
        <script>
        function validarBusqueda() {
            const valor = document.getElementById('busquedaInput').value.trim();
            if (valor === "") {
                return false;
            }
            return true;
        }
        </script>
    </div>
    @endif
    
    <div class="nav-right">
        @if(auth()->check())
        <a href="{{ route('') }}" class="nav-btn raleway-regular color-4 no-link-style">
            <i class="fas fa-user"></i> 
                
        @else
        <a href="{{ route('login') }}" class="nav-btn raleway-regular color-4 no-link-style">
            <i class="fa-solid fa-arrow-right-to-bracket"></i>
        @endif
        </a>
    </div>
</div>
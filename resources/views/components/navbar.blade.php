<div class="navbar navbar-{{ $type }} color-4 d-flex align-center justify-between">
    <div class="nav-left">
        <a href=" {{ route('home') }}" class="nav-btn raleway-regular color-4 no-link-style">WANNABOOK</a>
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
        <a href="{{ route('carro') }}" class="nav-btn color-4 no-link-style" style="position: relative;">
            <i class="fas fa-shopping-cart"></i>
            <span class="cart-count">
                {{ array_sum(array_column(session('cart', []), 'cantidad')) }}
            </span>
        </a>

        @if(auth()->check())
        <a href="{{ route('perfil.index', ['id' => Auth()->id()]) }}" class="nav-btn raleway-regular color-4 no-link-style">
            <i class="fas fa-user"></i> 
        </a>
        <a href="{{ route('logout') }}" class="nav-btn raleway-regular color-4 no-link-style"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
        </a>
                
        @else
        <a href="{{ route('register') }}" class="nav-btn raleway-regular color-4 no-link-style">
            <i class="fa-solid fa-arrow-right-to-bracket"></i>
        </a>
        @endif

    </div>
</div>
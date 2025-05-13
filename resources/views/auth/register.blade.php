<x-guest-layout>
    <div class="product-container" style="max-width: 400px; margin: 20px auto;">
        <h2 class="section-title text-center">Registro</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="low-margin-v">
                <input type="text" name="name" required class="search-input" style="width: 350px; margin-bottom: 10px;" 
                       placeholder="Nombre completo" value="{{ old('name') }}">
            </div>

            <!-- Email -->
            <div class="low-margin-v">
                <input type="email" name="email" required class="search-input" style="width: 350px; margin-bottom: 10px;" 
                       placeholder="Correo electrónico" value="{{ old('email') }}">
            </div>

            <!-- Password -->
            <div class="low-margin-v">
                <input type="password" name="password" required class="search-input" style="width: 350px; margin-bottom: 10px;" 
                       placeholder="Contraseña">
            </div>

            <!-- Confirm Password -->
            <div class="low-margin-v">
                <input type="password" name="password_confirmation" required class="search-input" style="width: 350px; margin-bottom: 10px;" 
                       placeholder="Confirmar contraseña">
            </div>

            <button type="submit" class="book-cart-btn w-full">
                Registrarse
            </button>

            <div class="text-center" style="margin-top: 15px;">
                <a href="{{ route('login') }}" 
                   class="nav-btn" style="color: #5f1854; font-size: 14px;">
                    ¿Ya tienes cuenta? Inicia sesión
                </a>
            </div>
        </form>
    </div>
</x-guest-layout>

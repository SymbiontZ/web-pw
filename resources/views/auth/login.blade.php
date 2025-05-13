<x-guest-layout>
    <div class="product-container" style="max-width: 400px; margin: 20px auto;">
        <h2 class="section-title text-center">Iniciar Sesión</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

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

            <!-- Remember Me -->
            <div class="low-margin-v" style="margin: 15px 0;">
                <label class="d-flex align-center">
                    <input type="checkbox" name="remember" class="mr-2">
                    <span>Recordar sesión</span>
                </label>
            </div>

            <button type="submit" class="book-cart-btn w-full">
                Ingresar
            </button>

            <div class="text-center" style="margin-top: 15px;">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" 
                       class="nav-btn" style="color: #5f1854; font-size: 14px;">
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif
            </div>
        </form>
    </div>
</x-guest-layout>

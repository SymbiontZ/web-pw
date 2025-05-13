<head>
    <link rel="stylesheet" href="{{ asset('css/palette.css') }}">
</head>
<div>
    {{-- Lista de reviews --}}
    @if($libro->reviews->count())
        @foreach($libro->reviews as $review)
            <div class="border p-3 my-2 rounded shadow-sm bg-white">
                <strong class="color-f-4">{{ $review->usuario }}</strong>
                <p class="mt-1">{{ $review->review }}</p>
                <p class="mt-1">Puntuación: {{ $review->puntuacion }}</p>
                <small class="text-muted">{{ $review->created_at->format('d/m/Y H:i') }}</small>
            </div>
        @endforeach
    @else
        <p class="text-gray-600">Aún no hay reseñas para este libro.</p>
    @endif

    @if(Auth::check())
        {{-- Formulario para añadir una nueva review --}}
        <form method="POST" action="{{ route('reviews.guardar') }}" class="mt-4">
            @csrf
            <input type="hidden" name="libro_id" value="{{ $libro->id_libro }}">
        
        <div class="mb-3">
            <label for="usuario" class="block text-sm font-medium">Tu nombre</label>
            <input type="text" name="usuario" id="usuario" value="{{ Auth::user()->nombre }}" required class="w-full border rounded px-3 py-2 mt-1" readonly>
        </div>

        <div class="mb-3">
            <label for="review" class="block text-sm font-medium">Tu reseña</label>
            <textarea name="review" id="review" required rows="3" class="w-full border rounded px-3 py-2 mt-1"></textarea>
        </div>

        <div class="mb-3">
            <label for="puntuacion" class="block text-sm font-medium">Tu puntuacion</label>
            <select name="puntuacion" id="puntuacion" required class="w-full border rounded px-3 py-2 mt-1">
                <option value="" disabled selected>Selecciona una puntuación</option>
                @for($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>
    <br>
        <button type="submit" class="filter-btn color-f-1 color-3" style="margin-bottom: 10px;">
            Enviar reseña
        </button>
        </form>
    @else
        <p class="text-gray-600 mt-4">Inicia sesión para dejar una reseña.</p>
        <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Iniciar sesión</a>
    @endif
</div>

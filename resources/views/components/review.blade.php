<div>
    {{-- Lista de reviews --}}
    @if($libro->reviews->count())
        @foreach($libro->reviews as $review)
            <div class="border p-3 my-2 rounded shadow-sm bg-white">
                <strong>{{ $review->usuario }}</strong>
                <p class="mt-1">{{ $review->content }}</p>
                <small class="text-muted">{{ $review->created_at->format('d/m/Y H:i') }}</small>
            </div>
        @endforeach
    @else
        <p class="text-gray-600">Aún no hay reseñas para este libro.</p>
    @endif

    {{-- Formulario para añadir una nueva review --}}
    <form method="POST" action="{{ route('reviews.guardar') }}" class="mt-4">
        @csrf
        <input type="hidden" name="libro_id" value="{{ $libro->id_libro }}">
        
        <div class="mb-3">
            <label for="usuario" class="block text-sm font-medium">Tu nombre</label>
            <input type="text" name="usuario" id="usuario" required class="w-full border rounded px-3 py-2 mt-1">
        </div>

        <div class="mb-3">
            <label for="review" class="block text-sm font-medium">Tu reseña</label>
            <textarea name="review" id="review" required rows="3" class="w-full border rounded px-3 py-2 mt-1"></textarea>
        </div>

        <div class="mb-3">
            <label for="puntuacion" class="block text-sm font-medium">Tu puntuacion</label>
            <textarea name="puntuacion" id="puntuacion" required rows="3" class="w-full border rounded px-3 py-2 mt-1"></textarea>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Enviar reseña
        </button>
    </form>
</div>

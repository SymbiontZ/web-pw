<div class="px-20 mt-20">
    <div class="align-center d-flex">
        <p class="section-title raleway-regular">{{ $titulo }}</p>
        <a class="ml-2 mt-5 no-link-style color-f-2 raleway-regular" href="/">Ver más</a>
    </div>
    <hr>
    @if (count($libros)>0)
        <div class="product-list">
        @foreach ($libros as $libro)
            <div class="product-container justify-center max-w color-1">
                <a href="{{ route('libros.show', ['id' => $libro->id_libro]) }}"> <!--route('detalles', ['id_libro' => $libro->id])-->
                    <img class="justify-center d-flex max-w"
                         src="{{ asset('images/' . $libro->imagen) }}"
                         alt="{{ $libro->titulo }} - {{ $libro->autor }}">
                </a>
                <hr>
                <div>
                    <a class="size-18 bold black-text no-link-style text-multiline-truncate"
                       href="/libro/{{ $libro->id_libro }}">
                        {{ strtoupper($libro->titulo) }}
                    </a>
                    <p class="size-14 low-margin-v">{{ $libro->autor }}</p>
                    <p class="size-16 bold text-right mt-20 mb-5">
                        {{ number_format($libro->precio, 2) }}€
                    </p>
                    <form method="POST" action="/"> <!-- route('añadir.carrito') -->
                        @csrf
                        <input type="hidden" name="id_libro" value="{{ $libro->id }}">
                        <button type="submit" name="añadir" class="hover-btn jetbrains-mono-regular color-3">
                            <i class="fas fa-cart-plus icon"></i>
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
        </div>
    @else
    <p>No hay resultados de esta búsqueda. Intenta con otra.</p>
    @endif
    <!-- Smile, breathe, and go slowly. - Thich Nhat Hanh -->
</div>
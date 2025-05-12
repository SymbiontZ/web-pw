<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BookList extends Component
{
    /**
     * Create a new component instance.
     */
    public $titulo;
    public $libros;
    public $orden;

    public function __construct($titulo, $libros, $orden)
    {
        $this->titulo = $titulo;
        $this->libros = $libros;
        $this->orden = $orden;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.book-list');
    }
}

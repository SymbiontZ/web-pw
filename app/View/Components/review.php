<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class review extends Component
{
    public $libro;

    public function __construct($libro)
    {
        $this->libro = $libro;
    }
   
    public function render(): \Illuminate\Contracts\View\View|Closure|string
    {
        return view('components.review');
    }
}

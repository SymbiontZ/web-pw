<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Libro extends Model
    {
        protected $table = 'libros';
        protected $primaryKey = 'id_libro';
        public $incrementing =true;
        protected $fillable = [
            'titulo',
            'autor',
            'precio',
            'paginas',
            'fecha',
            'editorial',
            'sinopsis',
            'imagen',
            'disponible'
            
        ];

        public function comprasTotal()
        {
            return $this->hasMany(Compra::class, 'id_libro')
                        ->selectRaw('id_libro, SUM(cantidad) as total')
                        ->groupBy('id_libro');
        }
    }
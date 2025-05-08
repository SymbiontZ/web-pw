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

        protected $casts = [
            'disponible' => 'boolean',
        ];

        public function scopeDisponibles($query)
        {
            return $query->where('disponible', true);
        }

        public function compras()
        {
            return $this->hasMany(Compra::class, 'id_libro');
        }

        public function categorias()
        {
            return $this->belongsToMany(Categoria::class, 'libros_categoria', 'id_libro', 'id_categoria');
        }

        public function comprasTotal()
        {
            return $this->hasMany(Compra::class, 'id_libro')
                        ->selectRaw('id_libro, SUM(cantidad) as total')
                        ->groupBy('id_libro');
        }

        public function reviews()
        {
            return $this->hasMany(Review::class, 'libro_id');
        }
    }
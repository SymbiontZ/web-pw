<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    protected $table = 'autores';
    protected $primaryKey = 'id_autor';
    public $incrementing = true;

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function libros()
    {
        return $this->hasMany(Libro::class, 'id_autor');
    }
}

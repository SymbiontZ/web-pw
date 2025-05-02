<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $table = "compras";
    protected $primaryKey = "id_compra";
    public $incrementing = true;

    // Relación con el modelo Libro (cada compra pertenece a un libro)
    public function libro()
    {
        return $this->belongsTo(Libro::class, 'id_libro'); // 'id_libro' es la clave foránea
    }

    // Relación con el modelo Usuario (cada compra pertenece a un usuario)
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario'); // 'id_usuario' es la clave foránea
    }

    protected $fillable = [
        'fecha',
        'cantidad',
    ];

    protected $casts = [
        'fecha' => 'date',
    ];
}

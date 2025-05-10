<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;
    protected $table = 'reviews';
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = ['libro_id', 'usuario', 'review', 'puntuacion'];
    
    public function libro()
    {
        return $this->belongsTo(Libro::class, 'libro_id');
    }
}

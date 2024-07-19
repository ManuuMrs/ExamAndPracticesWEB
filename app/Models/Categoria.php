<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre'
    ];

    public function peliculas()
    {
        return $this->belongsToMany(Pelicula::class, 'peliculas_categorias', 'categoria_id', 'pelicula_id');
    }
}

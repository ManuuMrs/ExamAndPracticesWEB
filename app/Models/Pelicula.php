<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelicula extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo', 'lanzamiento', 'productora_id', 'categoria_id'
    ];
    
    public function productora()
    {
        return $this->belongsTo(Productora::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function categorias()
    {
        return $this->belongsToMany(Categoria::class, 'peliculas_categorias', 'pelicula_id', 'categoria_id');
    }

    // public function categoria()
    // {
    //     return $this->belongsTo(Categoria::class, 'categoria_id');
    // }

    public function getPeliculas()
    {
        
        $peliculas = Pelicula::with(['productora', 'categoria'])->get();

        return response()->json($peliculas);
    }
}

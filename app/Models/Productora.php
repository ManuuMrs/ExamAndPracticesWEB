<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productora extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre'
    ];

    public function peliculas()
    {
        return $this->hasMany(Pelicula::class, 'productora_id');
    }
}

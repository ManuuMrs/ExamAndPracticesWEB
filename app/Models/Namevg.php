<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Namevg extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'producer',
        'owner',
        'releasedata',
        'digital',
        'weight',
    ];
}

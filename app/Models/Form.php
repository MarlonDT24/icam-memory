<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cover',
        'holder',
        'address',
        'cod_adress',
        'cif',
        'name_agent',
        'nif',
        'location',
        'cod_location',
        'activity',
        'description',
        'm_parcels',
        'm_surface',
        'requirements',
    ];

    protected $casts = [
       //
    ];
}

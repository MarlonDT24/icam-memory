<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LowVoltage extends Model
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

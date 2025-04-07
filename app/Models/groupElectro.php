<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GroupElectro extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cover',
        'holder',
        'address',
        'cod_address',
        'cif',
        'name_agent',
        'nif',
        'location',
        'cod_location',
        'name_location',
        'build',
        'kva',
        'kw',
        'tension_type',
        'budget',
        'type_clasi',
        'mark',
        'model',
        'voltage',
        'image_model',
        'image_dimensions',
        'air_entry',
        'air_flow',
        'w',
        'factor',
    ];

    protected $casts = [
       //
    ];
}

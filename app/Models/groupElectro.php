<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GroupElectro extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'author',
        'budget_excel',
        'holder',
        'cover',
        'address',
        'cod_address',
        'local_address',
        'town_address',
        'cif',
        'name_agent',
        'nif',
        'location',
        'cod_location',
        'name_location',
        'name_town',
        'build',
        'kva',
        'kw',
        'tension_type',
        'budget',
        'type_clasi',
        'mark',
        'model',
        'image_model',
        'image_dimensions',
        'voltage',
        'air_entry',
        'air_flow',
        'w',
        'factor',
        'fecha',
        'method',
    ];

    protected $casts = [
       //
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'plate',
        'brand',
        'model',
        'color',
        'year',
        'year_model',
        'version',
        'chassi',
        'fuel',
        'motor',
        'nationality',
        'uf',
        'city',
        'number_of_passengers',
    ];
}

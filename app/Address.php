<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'address';

    protected $fillable = [
        'address',
        'formatted_address',
        'reference_address',
        'neighborhood',
        'city',
        'uf',
        'zip_code',
    ];
}

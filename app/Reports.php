<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reports extends Model
{

    protected $table = 'reports';

    protected $fillable = [
        'service_type_id',
        'company_id',
        'fields_json'
    ];

    protected $hidden = [
        'company_id',
        'service_type_id'
    ];
}

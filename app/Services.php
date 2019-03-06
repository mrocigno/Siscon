<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    protected $table = 'services';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date_received',
        'identifier',
        'service_type_id',
        'address',
        'company_id',
        'service_description',
        'pg_guia',
        'calculated_pg_guia',
        'delivery_id',
        'applicant_id',
        'polo_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'company_id',
        'service_type_id',
        'delivery_id',
        'applicant_id',
        'polo_id'
    ];
}

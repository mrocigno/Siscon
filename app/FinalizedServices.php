<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FinalizedServices extends Model
{

    use SoftDeletes;
    protected $table = 'finalized_services';

    protected $fillable = [
        'distributed_service_id',
        'more_fields_json',
        'observation'
    ];


}

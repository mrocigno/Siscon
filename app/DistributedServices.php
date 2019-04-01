<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;;

class DistributedServices extends Model
{
    use SoftDeletes;

    protected $table = 'distributed_services';

    protected $fillable = [
        'service_id',
        'distributed_date',
        'user_id',
        'sequence',
    ];

    protected $hidden = [
        'service_id',
        'user_id',
    ];
}

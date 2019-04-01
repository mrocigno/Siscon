<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photos extends Model
{
    protected $table = 'photos';

    protected $fillable = [
        'finalized_service_id',
        'link'
    ];
}

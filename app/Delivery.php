<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Delivery extends Model {
    use SoftDeletes;

    protected $table = 'delivery';

    protected $fillable = ['company_id', 'name', 'num_services'];
    
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Polo extends Model
{
    use SoftDeletes;

    protected $table = 'polos';

    protected $fillable = ['polo', 'company_id'];
}

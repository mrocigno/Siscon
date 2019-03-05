<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Applicants extends Model{
    
    use SoftDeletes;

    protected $table = 'applicants';

    protected $fillable = ['company_id', 'name', 'email', 'telefone'];
    
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];
}

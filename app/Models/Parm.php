<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parm extends Model
{
    protected $fillable = [
        'value'
    ];
    protected $table = 'ds_parms';
}

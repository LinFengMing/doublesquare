<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $guarded = [
        'created_at',
        'updated_at'
    ];
    protected $table = 'ds_types';
}

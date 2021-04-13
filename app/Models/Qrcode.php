<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Qrcode extends Model
{
    protected $guarded = [
        'created_at',
        'updated_at'
    ];
    protected $table = 'ds_qrcodes';
}

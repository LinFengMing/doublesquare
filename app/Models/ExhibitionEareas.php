<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExhibitionEareas extends Model
{
    protected $guarded = [
        'created_at',
        'updated_at'
    ];
    protected $table = 'ds_exhibition_e_areas';

    public function exhibition()
    {
        return $this->belongsTo(Exhibition::class);
    }
}

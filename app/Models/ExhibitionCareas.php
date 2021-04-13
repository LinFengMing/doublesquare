<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExhibitionCareas extends Model
{
    protected $guarded = [
        'created_at',
        'updated_at'
    ];
    protected $table = 'ds_exhibition_c_areas';

    public function exhibition()
    {
        return $this->belongsTo(Exhibition::class);
    }

    public function exhibitionCareaElements()
    {
        return $this->hasMany(ExhibitionCareaElements::class, 'c_area_id', 'id');
    }
}

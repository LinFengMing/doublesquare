<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExhibitionDareas extends Model
{
    protected $guarded = [
        'created_at',
        'updated_at'
    ];
    protected $table = 'ds_exhibition_d_areas';

    public function exhibition()
    {
        return $this->belongsTo(Exhibition::class);
    }

    public function exhibitionDareaLeftElements()
    {
        return $this->hasMany(exhibitionDareaLeftElements::class, 'd_area_id', 'id');
    }

    public function exhibitionDareaMiddleElements()
    {
        return $this->hasMany(exhibitionDareaMiddleElements::class, 'd_area_id', 'id');
    }

    public function exhibitionDareaRightElements()
    {
        return $this->hasMany(exhibitionDareaRightElements::class, 'd_area_id', 'id');
    }
}

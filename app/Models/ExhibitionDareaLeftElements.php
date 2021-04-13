<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExhibitionDareaLeftElements extends Model
{
    protected $guarded = [
        'created_at',
        'updated_at'
    ];
    protected $table = 'ds_exhibition_d_area_left_elements';

    public function exhibitionDarea()
    {
        return $this->belongsTo(ExhibitionDareas::class);
    }
}

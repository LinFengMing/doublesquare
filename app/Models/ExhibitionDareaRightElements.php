<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExhibitionDareaRightElements extends Model
{
    protected $guarded = [
        'created_at',
        'updated_at'
    ];
    protected $table = 'ds_exhibition_d_area_right_elements';

    public function exhibitionDarea()
    {
        return $this->belongsTo(ExhibitionDareas::class);
    }
}

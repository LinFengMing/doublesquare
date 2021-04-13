<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExhibitionCareaElements extends Model
{
    protected $guarded = [
        'created_at',
        'updated_at'
    ];
    protected $table = 'ds_exhibition_c_area_elements';

    public function exhibitionCarea()
    {
        return $this->belongsTo(ExhibitionCareas::class);
    }
}

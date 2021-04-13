<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exhibition extends Model
{
    protected $guarded = [
        'created_at',
        'updated_at'
    ];
    protected $table = 'ds_exhibitions';

    public function exhibitionAarea()
    {
        return $this->hasone(ExhibitionAareas::class);
    }

    public function exhibitionBarea()
    {
        return $this->hasone(ExhibitionBareas::class);
    }

    public function exhibitionCarea()
    {
        return $this->hasone(ExhibitionCareas::class);
    }

    public function exhibitionDarea()
    {
        return $this->hasone(ExhibitionDareas::class);
    }

    public function exhibitionEarea()
    {
        return $this->hasone(ExhibitionEareas::class);
    }

    public function exhibitionCareaElements()
    {
        return $this->hasManyThrough(ExhibitionCareaElements::class, ExhibitionCareas::class, 'exhibition_id', 'c_area_id', 'id', 'id');
    }

    public function exhibitionDareaLeftElements()
    {
        return $this->hasManyThrough(ExhibitionDareaLeftElements::class, ExhibitionDareas::class, 'exhibition_id', 'd_area_id', 'id', 'id');
    }

    public function exhibitionDareaMiddleElements()
    {
        return $this->hasManyThrough(ExhibitionDareaMiddleElements::class, ExhibitionDareas::class, 'exhibition_id', 'd_area_id', 'id', 'id');
    }

    public function exhibitionDareaRightElements()
    {
        return $this->hasManyThrough(ExhibitionDareaRightElements::class, ExhibitionDareas::class, 'exhibition_id', 'd_area_id', 'id', 'id');
    }
}

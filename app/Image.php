<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [

        'apartment_id',
        'img_name',

    ];

    // Relation
    protected function apartment() {
        return $this->belongsTo('App\Apartment');
    }
}

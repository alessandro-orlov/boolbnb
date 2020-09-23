<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsorship extends Model
{
    protected $fillable = [

        'name',
        'price',
        'duration',

    ];

    // Relations
    protected function apartments() {
        return $this->belongsToMany('App\Apartment')->withPivot('start_date', 'end_date');
    }
}

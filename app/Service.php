<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [

        'name',

    ];

    // Relation
    protected function apartments() {
        return $this->belongsToMany('App\Apartment');
    }
}

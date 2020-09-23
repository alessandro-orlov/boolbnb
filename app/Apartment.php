<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    protected $fillable = [

        'user_id',
        'title',
        'num_rooms',
        'num_beds',
        'num_baths',
        'mq',
        'address',
        'latitude',
        'longitude',
        'description',
        'main_img',
        'price',
    ];


    // Relations

    protected function user() {
        return $this->belongsTo('App\User');
    }

    protected function messages() {
        return $this->hasMany('App\Message');
    }

    protected function visits() {
        return $this->hasMany('App\Visit');
    }

    protected function images() {
        return $this->hasMany('App\Image');
    }

    protected function services() {
        return $this->belongsToMany('App\Service');
    }

    protected function sponsorships() {
        return $this->belongsToMany('App\Sponsorship')->withPivot('start_date', 'end_date');
    }

}

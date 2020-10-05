<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;

class Apartment extends Model implements Viewable
{
    use InteractsWithViews;

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
        'city',
        'region',
        'description',
        'main_img',
        'price',
    ];


    // Relations

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function messages() {
        return $this->hasMany('App\Message');
    }

    public function visits() {
        return $this->hasMany('App\Visit');
    }

    public function images() {
        return $this->hasMany('App\Image');
    }

    public function services() {
        return $this->belongsToMany('App\Service');
    }

    public function sponsorships() {
        return $this->belongsToMany('App\Sponsorship')->withPivot('start_date', 'end_date');
    }


}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chef extends Model
{
    protected $fillable = [
        'business_name','business_email','business_phone', 'pickup_location','state','city', 'postal_code', 
         'experience','business_image','chef_description'
    ];

    public function award()
    {
        return $this->hasMany('App\Award');
    }
    public function cuisine()
    {
        return $this->hasMany('App\Cuisine');
    }
    public function dish()
    {
        return $this->hasMany('App\Dish');
    }
}

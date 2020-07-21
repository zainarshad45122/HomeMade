<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    protected $fillable = ['name','price','serving_size','cuisine_type','dietary_information','course_type','description','chef_id','halal'];
    public function ingredients()
    {
        return $this->hasMany('App\Ingredients');
    }
    public function dishimages()
    {
        return $this->hasMany('App\DishImage');
    }
     public function servingtime()
    {
        return $this->hasMany('App\ServingTiming');
    }
    
   

}

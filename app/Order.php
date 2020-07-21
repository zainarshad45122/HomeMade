<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
     protected $fillable = ['total_price','chef_id','user_id'];
       public function dishorder()
    {
        return $this->hasMany('App\DishOrder');
    }
}

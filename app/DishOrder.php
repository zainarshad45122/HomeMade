<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DishOrder extends Model
{
     protected $fillable = ['dish_id','order_id','user_id'];
}

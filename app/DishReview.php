<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DishReview extends Model
{
    protected $fillable = ['rating','comments','dish_id','user_id'];
}

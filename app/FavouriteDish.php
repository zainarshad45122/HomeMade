<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FavouriteDish extends Model
{
    protected $fillable = ['dish_id','user_id'];
}

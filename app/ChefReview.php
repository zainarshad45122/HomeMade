<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChefReview extends Model
{
     protected $fillable = ['rating','comments','chef_id','user_id'];
}

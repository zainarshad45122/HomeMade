<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserIdentity extends Model
{
    protected $fillable = [
         
        'nic_front_image',
        'nic_back_image',
        'nic_number'
    ];
}

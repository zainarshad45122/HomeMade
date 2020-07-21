<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name',  'email', 'password', 'image', 'phone_number', 'gender', 'date_of_birth', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {

            return $this->belongsToMany('App\Role');

    }
     public function orders()
    {

            return $this->hasMany('App\Order');
    }
      public function dishorders()
    {

            return $this->hasMany('App\DishOrder');
    }
    public function isChef()
    {
        if($this->role===2)
        {
            return true;
        }
        return false;
    }

    public function chef()
    {
        return $this->hasOne('App\Chef');
    }
}

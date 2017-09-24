<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','token','status',
    ];

    public function getNameAttribute($name)
    {
        return ucwords($name);
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function quotes()
    {
        return $this->hasMany('App\Quote');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}

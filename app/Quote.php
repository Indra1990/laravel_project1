<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
		use LikesTrait;

	protected $fillable = [
        'title', 'subject', 'slug','user_id',
    ];

    public function getTitleAttribute($title)
    {
        return ucwords($title);
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }


    public function isOwner()
    {
        if (Auth::guest()) {
            return false;
        }
    	return Auth::user()->id == $this->user->id;
    }
}

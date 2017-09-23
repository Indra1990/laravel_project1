<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
	protected $fillable = [
        'title', 'subject', 'slug','user_id',
    ];

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

    public function likes()
    {
        return $this->morphMany('App\likes','likeable');
    }

    public function isOwner()
    {
        if (Auth::guest()) {
            return false;
        }
    	return Auth::user()->id == $this->user->id; 
    }
}

<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
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

    public function likes()
    {
        //morphMany bisa ke dua model mempunyai fungsi yg sama
        return $this->morphMany('App\Like','likeable');
    }

    public function is_liked()
    {
        return $this->likes->where('user_id', Auth::user()->id)->count();
    }

    public function isOwner()
    {
        if (Auth::guest()) {
            return false;
        }
    	return Auth::user()->id == $this->user->id;
    }
}

<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	protected $fillable = [
         'subject', 'quote_id','user_id',
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function quote()
    {
        return $this->belongsTo('App\Quote');
    }

    public function likes()
    {
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

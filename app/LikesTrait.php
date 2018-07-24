<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

trait LikesTrait 
{
	public function likes()
	{
			return $this->morphMany('App\Like','likeable');
	}

	public function is_liked()
	{
			return $this->likes->where('user_id', Auth::user()->id)->count();
	}
}

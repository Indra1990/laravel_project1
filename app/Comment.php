<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	use LikesTrait;

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

  

	public function isOwner()
	{
		if (Auth::guest()) {
			return false;
		}

		return Auth::user()->id == $this->user->id;
	}
}

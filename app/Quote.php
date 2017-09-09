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

    public function isOwner()
    {
    	return Auth::user()->id == $this->user->id; 
    }
}

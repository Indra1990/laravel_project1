<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
	 protected $fillable = [
        'tag_name', 
    ];
    
   public function quotes()
   {
   		return $this->belongsToMany('App\Quote');
   }
}

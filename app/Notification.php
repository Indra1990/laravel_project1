<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
class Notification extends Model
{
  protected $guarded = ['id'];

  public function user()
  {
    return $this->belongsTo('App\User');
  }

  public function quote()
  {
    return $this->belongsTo('App\Quote');
  }
}

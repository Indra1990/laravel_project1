<?php

namespace App\Http\Controllers;

use Auth;
use App\Like;
use App\User;
use App\Quote;
use App\Comment;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function like($type, $model_id)
    {

      $result     = $this->check_type($type, $model_id);
      $model_type = $result[0];
      $model      = $result[1];

    	//user tidak boleh like sendiri
    	if (Auth::user()->id == $model->user->id)
    		die('0');

    	//user tidak boleh like berkali"
    	if ($model->is_liked() == null ) {
	    	Like::create([
	    		'user_id' => Auth::user()->id,
	    		'likeable_id' => $model_id,
	    		'likeable_type' => $model_type,
	    	]);
    	}

    }

    public function unlike($type, $model_id)
    {

      $result     = $this->check_type($type, $model_id);
      $model_type = $result[0];
      $model      = $result[1];

      //user tidak boleh like sendiri
      if (Auth::user()->id == $model->user->id)
        die('0');

      //user tidak boleh like berkali"
      if ($model->is_liked()) {
        Like::where('user_id',Auth::user()->id)
              ->where('likeable_id',$model_id)
              ->where('likeable_type', $model_type)
              ->delete();
      }

    }


    public function check_type($type, $model_id)
    {
      if ($type == 1){
        $model_type = "App\Quote";
        $model = Quote::find($model_id);
      }

      else{
        $model_type = "App\Comment";
        $model = Comment::find($model_id);
      }

      return  array($model_type, $model);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Quote;
use App\Notification;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function profile($id)
    {
      $user =User::findOrFail($id);
      return view('/profile',compact('user'));
    }

    public function getNotif()
    {
      
      $user = Auth::user();
      $notifications = Notification::where('user_id',$user->id)->orderBy('id','desc')->get();
      $notif_model = new Notification;
      return view('notifications',compact('notifications','notif_model','user'));
    }
}

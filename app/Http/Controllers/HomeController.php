<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Quote;

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
      $user =User::find($id);
      return view('/profile',compact('user'));
    }
}

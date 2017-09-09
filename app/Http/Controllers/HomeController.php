<?php

namespace App\Http\Controllers;

use Mail;
use Auth;
use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;

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
        if($id == null)      
        $user = User::findOrFail(Auth::user()->id);
        
        else
        $user = User::findOrFail($id);   
         
        return view('profile', compact('user'));
    }
}

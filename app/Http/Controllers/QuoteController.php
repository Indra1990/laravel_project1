<?php

namespace App\Http\Controllers;

use Auth;
use App\Tag;
use App\User;
use App\Quote;
use App\comment;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = urldecode($request->input('search'));
        if (!empty($search)) {
            $quotes =Quote::with('tags')->where('title','like','%'.$search.'%')->get();
        }
        else{
        $quotes = Quote::with('tags')->get();
        }

        $tags = Tag::all(); 
        return view('quotes.index', compact('quotes','tags'));
    }

    public function filter($tag)
    {
      
        $tags = Tag::all();
     
        $quotes = Quote::with('tags')->whereHas('tags', function($query) use($tag){
            $query->where('tag_name', $tag);
            })->get();
         

        return view('quotes.index', compact('quotes','tags'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        return view('quotes/create',compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation title and subject
        $this->validate($request,[

            'title' => 'required|min:3',
            'subject' => 'required|min:5',

            ]);
        //validation tags
        $request->tags = array_diff($request->tags, [0]);
        if(empty($request->tags)) 
            return redirect('quotes/create')->withInput($request->input())->with('tag_error','Tag Tidak Boleh Kosong');
        
        //create slug
        $slug = str_slug($request->title,'-');
        if (Quote::where('slug',$slug)->first() !=null)
            $slug = $slug .'-'.time();

        $quotes = Quote::create([

            'title'   => $request->title,
            'slug'    => $slug,
            'subject' => $request->subject,
            'user_id' => Auth::user()->id

            ]);


        $quotes->tags()->attach($request->tags);

        return redirect('quotes')->with('msg', 'kutipan berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $lug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $quote = Quote::with('comments.user')->where('slug', $slug)->first();

        if (empty($quote)) {
            abort(404);
        }

        return view('quotes.single',compact('quote'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $quote = Quote::find($id);
        $tags = Tag::all();
        return view('quotes.edit',compact('quote','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         //validation title and subject
        $this->validate($request,[

            'title' => 'required|min:3',
            'subject' => 'required|min:5',

            ]);
         //validation tags
        $request->tags = array_diff($request->tags, [0]);
        if(empty($request->tags)) 
            return back()->withInput($request->input())->with('tag_error','Tag Tidak Boleh Kosong');

        $quote = Quote::find($id);
        if($quote->isOwner()){
        $quote->update([
                'title' => $request->title,
                'subject' => $request->subject,
            ]);

        $quote->tags()->sync($request->tags);
        }
        else{

            abort(403);
        }
        return redirect('/quotes')->with('msg','berhasil update quote');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quote = Quote::find($id);
        if($quote->isOwner()){

            $quote->delete();
        }
        else{

            abort(403);
        }
        return redirect('/quotes')->with('msg','berhasil dihapus quote');
    }

    public function random()
    {
        $quote = Quote::inRandomOrder()->first();



        return view('quotes.single',compact('quote'));
    }
}

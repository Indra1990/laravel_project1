<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Quote;
use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $id)
    {
    	$this->validate($request,[
    			'subject' => 'required|min:5',
    		]);

    	$quote = Quote::findOrFail($id);

    	$comment = Comment::create([

    			'subject' => $request->subject,
    			'quote_id'=> $id,
    			'user_id' => Auth::user()->id,
    		]);

    	return redirect('/quotes/'.$quote->slug)->with('msg', 'komentar berhasil di submit');
    }

    public function edit($id)
    {
      $comment = Comment::findOrFail($id);
      return view('comment.edit', compact('comment'));
    }

    public function update(Request $request, $id)
    {
      $this->validate($request,[
          'subject' => 'required|min:5',
        ]);

      $comment = Comment::findOrFail($id);
        if ($comment->isOwner()) {
            $comment->update([
              'subject' => $request->subject,
            ]);
        }else {
          abort(403);
        }
      return redirect('/quotes/'.$comment->quote->slug)->with('msg', 'komentar berhasil di edit');
    }

    public function destroy($id)
    {
      $comment = Comment::findOrFail($id);
      if ($comment->isOwner()) {
        $comment->delete();
      }else {
        abort(403);
      }

      return redirect('/quotes/'.$comment->quote->slug)->with('msg', 'komentar berhasil di hapus');
    }

}

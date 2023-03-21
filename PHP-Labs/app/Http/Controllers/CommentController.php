<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
class CommentController extends Controller
{
    public function store(Request $request)
    {
 
        Comment::create([
            'user_id' => $request->user_id,
            'body' => $request->body,
            'commentable_id' => $request->commentable_id,
            'commentable_type' => $request->commentable_type,
        ]);
        
        return back();
    }
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return back();
    }
    public function update($id,Request $request){
        $comment = Comment::findOrFail($id);
        $comment->body = $request->body;
        $comment->save();

        return back();
    }
}
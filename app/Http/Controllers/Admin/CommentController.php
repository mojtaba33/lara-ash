<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function unapproved()
    {
        $comments = Comment::where('approved',0)->latest()->paginate(20);
        return view('admin.comment.unapproved',compact('comments'));
    }

    public function approved()
    {
        $comments = Comment::where('approved',1)->latest()->paginate(20);
        return view('admin.comment.approved',compact('comments'));
    }

    public function reply(Comment $comment)
    {
        return view('admin.comment.reply',compact('comment'));
    }

    public function answer(Request $request , Comment $comment)
    {
        //dd($comment);
        $request->validate([
            'body' => 'required',
        ]);

        auth()->user()->comments()->create([
            'body' => $request->input('body'),
            'commentable_id' => $comment->commentable_id,
            'commentable_type' => $comment->commentable_type,
            'parent_id' => $comment->id,
            'approved' => 1 ,
        ]);

        $comment->approved = 1;

        $comment->save();

        return redirect(route('comment.approved'))->with('message' , 'عملیات با موفقیت انجام شد.');
    }

    public function confirm(Comment $comment)
    {
        $comment->approved = 1;
        $comment->save();

        return back()->with('message' , 'عملیات با موفقیت انجام شد.');

    }

    public function destroy(Comment $comment)
    {
        $this->removeChild($comment->childes()->get());
        $comment->delete();
        return back()->with('message' , 'عملیات با موفقیت انجام شد.');
    }

    private function removeChild($comments)
    {
        foreach ($comments as $comment){
            if ($comment->childes()->get()->isNotEmpty()){
                $this->removeChild($comment->childes()->get());
            }else{
                $comment->delete();
            }
        }

    }

}

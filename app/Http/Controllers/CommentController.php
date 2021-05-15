<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required',
            'rating' => 'numeric|min:0|max:5',
        ]);

        $commentable_type = $request->input('commentable_type');

        if ( json_decode($request->input('commentable_type')) != null )
        {
            $commentable_type = json_decode($request->input('commentable_type'));
        }

        auth()->user()->comments()->create([
            'body' => $request->input('body'),
            'parent_id' => $request->input('parent_id'),
            'commentable_id' => $request->input('commentable_id'),
            'commentable_type' => $commentable_type,
            'rate' => $request->input('rate') != null ? $request->input('rate') : 0 ,
        ]);

        return back()->with('message','Your review has been successfully registered.We will display it after it approved by admin');
    }
}

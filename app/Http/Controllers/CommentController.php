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

        auth()->user()->comments()->create([
            'body' => $request->input('body'),
            'product_id' => $request->input('product_id'),
            'parent_id' => $request->input('parent_id'),
            'rate' => $request->input('rate') != null ? $request->input('rate') : 0 ,
        ]);

        return back()->with('message','Your review has been successfully registered');
    }
}

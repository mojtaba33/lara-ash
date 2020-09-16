<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile()
    {
        if (!auth()->check())
        {
            return back();
        }

        $user = auth()->user();
        $payment = $user->checkouts()->where('payment',1)->get();

        return view('default.user.profile',compact('user','payment'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'image'
        ]);

        if ($request->file('image'))
        {
            $image = $this->uploadImage($request->file('image'),'upload/images/user');
            auth()->user()->update([
                'image' => $image
            ]);
        }

        auth()->user()->update([
            'name' => $request->input('name')
        ]);

        return back()->with('message','done!');
    }

    public function uploadImage($file , $path)
    {
        $fileName= time().'-'.$file->getClientOriginalName();
        $file->move(public_path($path),$fileName);
        return $path.'/'.$fileName;
    }
}

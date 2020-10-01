<?php

namespace App\Http\Controllers\Admin;

use App\Banner;
use Illuminate\Http\Request;

class BannerController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::latest()->paginate(20);
        return view('admin.banner.index',compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'url' => 'required',
            'image' => 'required|image',
        ]);

        $image =$this->uploadImage($request->file('image'),'upload/images/banner');

        Banner::create([
            'title' => $request->input('title'),
            'image' => $image,
            'description' => $request->input('description'),
            'position' => $request->input('position'),
            'show' => $request->input('show') == 'on' ? true : false ,
            'url' => $request->input('url') ,
        ]);

        return back()->with(['message' => 'عملیات با موفقیت انجام شد.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        return view('admin.banner.edit',compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'title' => 'required',
            'url' => 'required',
        ]);

        $image = $banner->image;
        if ($request->file('image')){
            $this->deleteImage($banner);
            $image =$this->uploadImage($request->file('image'),'upload/images/banner');
        }

        $banner->update([
            'title' => $request->input('title'),
            'image' => $image,
            'description' => $request->input('description'),
            'position' => $request->input('position'),
            'show' => $request->input('show') == 'on' ? true : false ,
            'url' => $request->input('url') ,
        ]);

        return back()->with(['message' => 'عملیات با موفقیت انجام شد.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Banner $banner
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Banner $banner)
    {
        $this->deleteImage($banner);
        $banner->delete();
        return back()->with(['message' => 'عملیات با موفقیت انجام شد.']);
    }

    public function deleteImage(Banner $banner)
    {
        if (file_exists(public_path($banner->image)))
            unlink(file_exists(public_path($banner->image)));
    }
}

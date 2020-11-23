<?php

namespace App\Http\Controllers\Admin;

use App\Blog;
use App\Category;
use Illuminate\Http\Request;

class BlogController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::latest()->paginate(20);
        return view('admin.blog.index',compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('parent_id' , '!=' , 0)->get();
        return view('admin.blog.create',compact('categories'));
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
            'category_id' => 'required',
            'title' => 'required',
            'image' => 'required|image',
            'body' => 'required',
            'tags'      => 'required',
        ]);

        $image = $this->uploadImage($request->file('image') , 'upload/images/blog');

        auth()->user()->blogs()->create([
            'category_id'   => $request->input('category_id'),
            'title'         => $request->input('title'),
            'image'         => $image,
            'body'          => $request->input('body'),
            'tags'          => $request->input('tags'),
        ]);

        return back()->with(['message' => 'عملیات با موفقیت انجام شد.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        $categories = Category::where('parent_id' , '!=' , 0)->get();
        return view('admin.blog.edit',compact('categories','blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'category_id' => 'required',
            'title'       => 'required',
            'image'       => 'image',
            'body'        => 'required',
            'tags'      => 'required',
        ]);

        $image = $blog->image;

        if ($request->file('image'))
        {
            $this->deleteImages($blog);

            $image = $this->uploadImage($request->file('image') , 'upload/images/blog');
        }

        $blog->update([
            'category_id'   => $request->input('category_id'),
            'title'         => $request->input('title'),
            'image'         => $image,
            'body'          => $request->input('body'),
            'tags'          => $request->input('tags'),
        ]);

        return back()->with(['message' => 'عملیات با موفقیت انجام شد.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog $blog
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Blog $blog)
    {
        $this->deleteImages($blog);

        $blog->delete();

        return back()->with(['message' => 'عملیات با موفقیت انجام شد.']);
    }

    protected function deleteImages(Blog $blog)
    {
        if (file_exists(public_path($blog->image)))
        {
            unlink(public_path($blog->image));
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Collection;

class CategoryController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(20);
        return view('admin.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('parent_id',0)->get();
        return view('admin.category.create',compact('categories'));
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
            'parent_id' => 'required',
            'title' => 'required',
            'image' => 'image',
        ]);

        $image = null;
        if ($request->file('image'))
            $image =$this->uploadImage($request->file('image'),'upload/images/category');

        Category::create([
            'parent_id' => $request->input('parent_id'),
            'title' => $request->input('title'),
            'image' => $image,
            'description' => $request->input('description'),
            'position' => $request->input('position'),
            'show' => $request->input('show') == 'on' ? true : false ,
        ]);

        return back()->with(['message' => 'عملیات با موفقیت انجام شد.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $categories = Category::where('parent_id' , 0)->where('id','!=',$category->id)->get();
        return view('admin.category.edit',compact('category','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'parent_id' => 'required',
            'title' => 'required',
            'image' => 'image',
        ]);

        if ($request->file('image')) {

            if ($category->image != null)
                if (file_exists(public_path($category->image)))
                    unlink(public_path($category->image));

            $image = $this->uploadImage($request->file('image'),'upload/images/category');
            $category->update(['image' => $image]);
        }

        $category->update([
            'parent_id' => $request->input('parent_id'),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'position' => $request->input('position'),
            'show' => $request->input('show') == 'on' ? true : false ,
        ]);

        return back()->with(['message' => 'عملیات با موفقیت انجام شد.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Category $category)
    {
        $category->delete();

        if ($category->image != null)
            if (file_exists(public_path($category->image)))
                unlink(public_path($category->image));

        if ($category->parent_id == 0)
            foreach ($category->children()->get() as $child)
            {
                $child->delete();
            }

        if ($category->image != null)
            if (file_exists(public_path($category->image)))
                unlink(public_path($category->image));

        return back()->with(['message' => 'عملیات با موفقیت انجام شد.']);
    }
}

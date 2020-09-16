<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Filter;
use App\Http\Controllers\Controller;
use App\Http\Resources\FilterCollection;
use Illuminate\Http\Request;
use \App\Http\Resources\Filter as FilterResource;


class FilterController extends Controller
{
    public function add(Request $request)
    {

        $category_id = $request->input('category_id');
        $parent_id = $request->input('parent_id');
        $title = $request->input('title');

        $filter = Category::find($category_id)->filters()->create([
            'parent_id' => $parent_id,
            'title' => $title
        ]);

        return response()->json([
            'data' => new FilterResource($filter),
            'message'=>'عملیات با موفقیت انجام شد.'
        ]);
    }

    public function getFilters(Request $request)
    {
        $category_id = $request->input('category_id');

        return response()->json([
            'data' => new FilterCollection(Category::find($category_id)->filters()->get()),
            'parent' => new FilterCollection(Category::find($category_id)->filters()->where('parent_id',0)->get()),
        ]);
    }

    public function delete(Request $request)
    {
        $filter_id = $request->input('filter_id');

        Filter::find($filter_id)->delete();

        return response()->json([
            'message' => 'عملیات با موفقیت انجام شد.'
        ]);
    }

    public function filter(Category $category)
    {
        if ($category->parent_id == 0){
            return redirect(route('category.index'))->with([
                'message' => 'این ویژگی برای دسته بندی سرگروه تعیین نشده است.',
                'status'  => ' ناموفق ',
                'type'  => 'warning',
            ]);
        }

        return view('admin.category.filter' , compact('category'));
    }
}

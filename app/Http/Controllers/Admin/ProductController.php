<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Filter;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->paginate(20);
        return view('admin.product.index' , compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('parent_id' , '!=' , 0)->get();
        return view('admin.product.create',compact('categories'));
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
            'brand' => 'required',
            'body' => 'required',
            'price' => 'required',
            'discount' => 'numeric',
            'count' => 'required|numeric',
            'status' => 'required',
            'top_offer' => '',
            'color'      => 'required',
            'size'      => 'required',
        ]);

        $image = $this->uploadImage($request->file('image') , 'upload/images/product',[
            ['width' => null,'height'=>360 ],
            ['width' => 90  ,'height' => 90],
            ['width' => 420 ,'height'=>null]
        ]);

        auth()->user()->products()->create([
            'category_id' => $request->input('category_id'),
            'title' => $request->input('title'),
            'image' => $image,
            'brand' => $request->input('brand'),
            'body' => $request->input('body'),
            'color' => $request->input('color'),
            'size' => $request->input('size') != null ? implode(',',$request->input('size')) : null,
            'price' => $request->input('price'),
            'discount' => $request->input('discount'),
            'count' => $request->input('count'),
            'status' => $request->input('status'),
            'top_offer' => $request->input('top_offer') == 'on' ? true : false,
        ]);

        return back()->with(['message' => 'عملیات با موفقیت انجام شد.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::where('parent_id' , '!=' , 0)->get();
        return view('admin.product.edit',compact('categories','product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => 'required',
            'title'       => 'required',
            'image'       => 'image',
            'brand'       => 'required',
            'body'        => 'required',
            'price'       => 'required',
            'discount'    => 'numeric',
            'count'       => 'required|numeric',
            'status'      => 'required',
            'color'      => 'required',
            'size'      => 'required',
        ]);

        $image = $product->image;

        if ($request->file('image'))
        {
            $this->deleteProductImages($product);

            $image = $this->uploadImage($request->file('image') , 'upload/images/product',[
                ['width' => null,'height' => 360 ],
                ['width' => 90  ,'height' => 90],
                ['width' => 420 ,'height' => null]
            ]);
        }

        $product->update([
            'category_id' => $request->input('category_id'),
            'title' => $request->input('title'),
            'image' => $image,
            'brand' => $request->input('brand'),
            'body' => $request->input('body'),
            'color' => $request->input('color'),
            'size' => $request->input('size') != null ? implode(',',$request->input('size')) : null,
            'price' => $request->input('price'),
            'discount' => $request->input('discount'),
            'count' => $request->input('count'),
            'status' => $request->input('status'),
            'top_offer' => $request->input('top_offer') == 'on' ? true : false,
        ]);

        return back()->with(['message' => 'عملیات با موفقیت انجام شد.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Product $product)
    {
        $this->deleteProductImages($product);

        foreach ($product->galleries()->get() as $gallery){
            if (file_exists(public_path($gallery->image)))
                unlink(public_path($gallery->image));
            $gallery->delete();
        }

        $product->delete();

        return back()->with(['message' => 'عملیات با موفقیت انجام شد.']);
    }

    public function option(Product $product)
    {
        $filters = $product->category()->first()->filters()->where('parent_id',0)->get();
        //dd($filters);
        return view('admin.product.option',compact('product','filters'));
    }

    public function addOption(Request $request,Product $product)
    {
        foreach ($request->all() as $key=>$value){
            $request->validate([
                (string)$key => 'max:255',
            ]);
        }

        foreach ($request->all() as $key=>$value){

            if ($key == '_token'){
                continue;
            }

            $filter = Filter::findOrFail($key);

            if(DB::table('filter_product')->where('product_id',$product->id)->where('filter_id',$key)->first()){
                $product->filters()->updateExistingPivot($filter, ['value' => $value,]);
            }else{
                $product->filters()->save($filter,['value' => $value,]);
            }
        }

        return back()->with( 'message' , 'عملیات با موفقیت انجام شد.' );
    }

    /**
     * @param Product $product
     */
    public function deleteProductImages(Product $product)
    {
        foreach ($product->image as $image) {
            if (file_exists(public_path($image)))
                unlink(public_path($image));
        }
    }

}

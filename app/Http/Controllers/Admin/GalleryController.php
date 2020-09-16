<?php

namespace App\Http\Controllers\Admin;

use App\Gallery;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class GalleryController extends AdminController
{
    /**
     * @param Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function gallery(Product $product)
    {
        $galleries = $product->galleries()->get();
        return view('admin.product.gallery',compact('product','galleries'));
    }

    /**
     * @param Request $request
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function addImageToGallery(Request $request , Product $product)
    {
        $request->validate([
            'file' => 'image'
        ]);

        $image = $this->uploadImage($request->file('file') , 'upload/images/gallery',[
            ['width' => 125,'height'=>null ],
            ['width' => 420  ,'height' => null],
        ]);

        $product->galleries()->create([
            'image' => $image,
        ]);

        return response()->json('success',200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gallery $gallery
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Gallery $gallery)
    {
        foreach ($gallery->image as $image)
            if (file_exists(public_path($image)))
                unlink(public_path($image));

        $gallery->delete();

        return back()->with(['message' => 'عملیات با موفقیت انجام شد.']);
    }
}

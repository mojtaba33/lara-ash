<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{
    /**
     * @param $file
     * @param $path
     * @param null $sizes
     * @return mixed|string
     */
    public function uploadImage($file , $path , array $sizes = null)
    {
        /*$file,'admin/upload/product',[['width'=>50,'height'=>50],['width'=>350,'height'=>350],['width'=>200,'height'=>200],['width'=>500,'height'=>500]]*/
        if ($sizes == null){
            $fileName= time().'-'.$file->getClientOriginalName();
            $file->move(public_path($path),$fileName);
            return $path.'/'.$fileName;
        }

        $fileName= time().'-'.$file->getClientOriginalName();
        $image=$file->move(public_path($path),$fileName);
        $resize=$this->resizeImage($fileName,$image,$path,$sizes);
        $resize['original']= $path.'/'.$fileName ;
        return $resize;
    }

    /**
     * @param $fileName
     * @param $file
     * @param $path
     * @param $sizes
     * @return mixed
     */
    public function resizeImage($fileName, $file, $path, array $sizes)
    {
        foreach ($sizes as $size){
            $img = Image::make($file)
                ->resize($size['width'], $size['height'],function ($constraint) {
                    $constraint->aspectRatio();
                })->save(
                    $path.'/'.(string)$size['width'].'x'.(string)$size['height'].'_'.$fileName
                );
            $result [$size['width'] != null ? $size['width'] : $size['height'] ]= $path.'/'.$img->basename;
        }

        return $result;
    }

    /**
     * @param Request $request
     * @return string
     */
    public function ckUpload(Request $request)
    {
        if($request->hasFile('upload')) {
            $file = $request->file('upload');
            $fileName = rand() . time() . $file->getClientOriginalName();
            $file->move(public_path('upload/cdEditor/'), $fileName);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = '/upload/cdEditor/'.$fileName;
            $msg = 'تصویر با موفقیت آپلود شد.';
            return "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
        }
    }
}

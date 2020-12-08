<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Coupon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::latest()->paginate(20);
        return view('admin.coupon.index',compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('parent_id' ,'<>' , 0)->get();
        return view('admin.coupon.create',compact('categories'));
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
            'value' => 'required',
            'code' => 'required',
            'expired_at' => 'required',
            'category_id' => 'required',
        ]);

        $coupon = Coupon::create([
            'value' => $request->input('value'),
            'code' => $request->input('code'),
            'expired_at' => $request->input('expired_at'),
        ]);

        $coupon->categories()->attach($request->input('category_id'));

        return back()->with('message' , 'عملیات با موفقیت انجام شد.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        $categories = Category::where('parent_id' ,'<>' , 0)->get();
        return view('admin.coupon.edit',compact('categories','coupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        $request->validate([
            'value' => 'required',
            'code' => 'required',
            'expired_at' => 'required',
            'category_id' => 'required',
        ]);

        $coupon->update([
            'value' => $request->input('value'),
            'code' => $request->input('code'),
            'expired_at' => $request->input('expired_at'),
        ]);

        $coupon->categories()->sync($request->input('category_id'));

        return back()->with('message' , 'عملیات با موفقیت انجام شد.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Coupon $coupon
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return back()->with('message' , 'عملیات با موفقیت انجام شد.');
    }
}

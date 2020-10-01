<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Service;
use Illuminate\Http\Request;

class ServiceController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::paginate(20);
        return view('admin.service.index',compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.service.create');
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
            'image' => 'required|image',
            'title' => 'required',
            'label' => 'required',
        ]);

        $image =$this->uploadImage($request->file('image'),'upload/images/service');

        Service::create([
            'image' => $image,
            'title' => $request->input('title'),
            'label' => $request->input('label'),
        ]);

        return back()->with(['message' => 'عملیات با موفقیت انجام شد.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        return view('admin.service.edit',compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'image' => 'required|image',
            'title' => 'required',
            'label' => 'required',
        ]);

        $image = $service->image;
        if ($request->file('image')){
            $this->deleteImage($service);
            $image = $this->uploadImage($request->file('image'),'upload/images/service');
        }

        $service->update([
            'image' => $image,
            'title' => $request->input('title'),
            'label' => $request->input('label'),
        ]);

        return back()->with(['message' => 'عملیات با موفقیت انجام شد.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Service $service
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Service $service)
    {
        $this->deleteImage($service);
        $service->delete();
        return back()->with(['message' => 'عملیات با موفقیت انجام شد.']);
    }

    public function deleteImage(Service $service)
    {
        if (file_exists(public_path($service->image)))
            unlink(file_exists(public_path($service->image)));
    }
}

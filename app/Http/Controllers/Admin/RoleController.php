<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Permission;
use App\Role;
use foo\bar;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::paginate(20);
        return view('admin.role.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.role.create',compact('permissions'));
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
            'fa_title' => 'required',
            'permission_id' => 'required',
        ]);

        $role = Role::create([
            'title' => $request->input('title'),
            'fa_title' => $request->input('fa_title'),
        ]);

        $role->permissions()->attach($request->input('permission_id'));

        return back()->with( 'message' , 'عملیات با موفقیت انجام شد.' );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.role.edit',compact('permissions','role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'title' => 'required',
            'fa_title' => 'required',
            'permission_id' => 'required',
        ]);

        $role->update([
            'title' => $request->input('title'),
            'fa_title' => $request->input('fa_title'),
        ]);

        $role->permissions()->sync($request->input('permission_id'));

        return back()->with( 'message' , 'عملیات با موفقیت انجام شد.' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        $role->permissions()->detach();
        return back()->with( 'message' , 'عملیات با موفقیت انجام شد.' );

    }
}

@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">

            @if(session()->has('message'))
                @component('admin.component.alert')
                    @slot('class')
                        success
                    @endslot
                    @slot('status')

                    @endslot
                    {{ session('message') }}
                @endcomponent
            @endif

            <section class="panel">
                <header class="panel-heading">
                    {{ __('ویرایش مقام ' . $role->title) }}
                </header>
                <div class="panel-body">
                    <div class="form">
                        <form  method="post" action="{{ route('role.update',$role) }}"  class="cmxform form-horizontal tasi-form" id="signupForm">
                            @csrf
                            @method('patch')
                            <div class="form-group ">
                                <label for="title" class="control-label col-lg-2">عنوان</label>
                                <div class="col-lg-10">
                                    <input id="title" name="title" type="text" value="{{$role->title}}" class="form-control @error('title') error @enderror" />
                                    @error('title')
                                        <label for="title" class="error">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group ">
                                <label for="fa_title" class="control-label col-lg-2">عنوان فارسی</label>
                                <div class="col-lg-10">
                                    <input id="fa_title" name="fa_title" type="text" value="{{$role->fa_title}}" class="form-control @error('fa_title') error @enderror" />
                                    @error('fa_title')
                                    <label for="fa_title" class="error">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-2" for="permission_id">سطوح دسترسی</label>
                                <div class="col-lg-10">

                                    <select multiple="" class="form-control" name="permission_id[]" id="permission_id">
                                        @foreach($permissions as $permission)
                                            <option value="{{ $permission->id }}" {{ $role->hasPermission($permission)  ? 'selected' : '' }}>{{ $permission->fa_title . " - " . $permission->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button class="btn btn-danger" type="submit">ثبت</button>
                                    <button class="btn btn-default" type="reset">انصراف</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

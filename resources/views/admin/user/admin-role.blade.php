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
                    {{ __('ویرایش کاربر ' . $user->email) }}
                </header>
                <div class="panel-body">
                    <div class="form">
                        <form  method="post" action="{{ route('user.setRole',$user) }}"  class="cmxform form-horizontal tasi-form" id="signupForm">
                            @csrf
                            @method('patch')
                            <div class="form-group ">
                                <label for="name" class="control-label col-lg-2">نام</label>
                                <div class="col-lg-10">
                                    <input id="name" name="name" disabled type="text" value="{{$user->name}}" class="form-control @error('name') error @enderror" />
                                    @error('name')
                                        <label for="name" class="error">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="email" class="control-label col-lg-2">ایمیل</label>
                                <div class="col-lg-10">
                                    <input id="email" name="email" disabled type="text" value="{{$user->email}}" class="form-control @error('email') error @enderror" />
                                    @error('email')
                                    <label for="email" class="error">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-lg-2" for="role_id">سرگروه</label>
                                <div class="col-lg-10">
                                    <select class="form-control m-bot15" name="role_id[]" id="role_id" multiple>
                                        @foreach($roles as $role)
                                        <option value="{{ $role->id }}" {{ $user->hasRole($role) ? "selected" : '' }}>{{ $role->fa_title . " - " . $role->title }}</option>
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

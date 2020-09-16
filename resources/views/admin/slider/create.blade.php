@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">

            <x-admin-alert :message="'message'" status="عملیات موفق" type="success" ></x-admin-alert>

            <section class="panel">
                <header class="panel-heading">
                    {{ __('افزودن اسلاید جدید') }}
                </header>
                <div class="panel-body">
                    <div class="form">
                        <form  method="post" action="{{ route('slider.store') }}" class="cmxform form-horizontal tasi-form" id="signupForm">
                            @csrf
                            <div class="form-group ">
                                <label for="label" class="control-label col-lg-2">لیبل</label>
                                <div class="col-lg-10">
                                    <input id="label" name="label" type="text" value="{{old('label')}}" class="form-control @error('label') error @enderror" />
                                    @error('label')
                                    <label for="label" class="error">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="title" class="control-label col-lg-2">عنوان</label>
                                <div class="col-lg-10">
                                    <input id="title" name="title" type="text" value="{{old('title')}}" class="form-control @error('title') error @enderror" />
                                    @error('title')
                                    <label for="title" class="error">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group ">
                                <label for="url" class="control-label col-lg-2">آدرس</label>
                                <div class="col-lg-10">
                                    <input id="url" name="url" type="text" value="{{old('url')}}" class="form-control @error('url') error @enderror" />
                                    @error('url')
                                    <label for="url" class="error">{{ $message }}</label>
                                    @enderror
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

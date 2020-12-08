@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">

            <x-admin-alert :message="'message'" status="عملیات موفق" type="success" ></x-admin-alert>

            <section class="panel">
                <header class="panel-heading">
                    {{ __('افزودن کد تخفیف جدید') }}
                </header>
                <div class="panel-body">
                    <div class="form">
                        <form  method="post" action="{{ route('admin.coupon.store') }}" enctype="multipart/form-data" class="cmxform form-horizontal tasi-form" id="signupForm">
                            @csrf
                            <div class="form-group ">
                                <label for="code" class="control-label col-lg-2">کد تخفیف</label>
                                <div class="col-lg-10">
                                    <input id="code" name="code" type="text" value="{{old('code')}}" class="form-control @error('code') error @enderror" />
                                    @error('code')
                                    <label for="code" class="error">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="value" class="control-label col-lg-2">مقدار تخفیف(درصد)</label>
                                <div class="col-lg-10">
                                    <input id="value" name="value" type="number" min="1" max="100" value="{{old('value')}}" class="form-control @error('value') error @enderror" />
                                    @error('value')
                                    <label for="value" class="error">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="expired_at" class="control-label col-lg-2">زمان انقضا</label>
                                <div class="col-lg-10">
                                    <input type="datetime-local" id="expired_at" name="expired_at" value="{{old('expired_at')}}" class="form-control @error('expired_at') error @enderror">
                                    @error('expired_at')
                                    <label for="expired_at" class="error">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-2" for="category_id">دسته بندی</label>
                                <div class="col-lg-10">
                                    <select class="form-control m-bot15" multiple name="category_id[]" id="category_id">
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->title }}</option>
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

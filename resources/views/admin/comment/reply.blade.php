@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">

            <x-admin-alert :message="'message'" status="عملیات موفق" type="success" ></x-admin-alert>


            <section class="panel">
                <header class="panel-heading">
                    {{ __('پاسخ به نظر' . $comment->user->name) }}
                </header>
                <div class="panel-body">
                    <div class="form">
                        <form  method="post" action="{{ route('comment.answer',$comment) }}" class="cmxform form-horizontal tasi-form" id="signupForm">
                            @csrf
                            <div class="form-group ">
                                <label for="title" class="control-label col-lg-2">متن نظر</label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" disabled>{{ $comment->body }}</textarea>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="body" class="control-label col-lg-2">متن نظر</label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" rows="5" name="body"></textarea>
                                    @error('body')
                                    <label for="body" class="error">{{ $message }}</label>
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

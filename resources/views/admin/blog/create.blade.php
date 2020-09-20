@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">

            <x-admin-alert :message="'message'" status="عملیات موفق" type="success" ></x-admin-alert>

            <section class="panel">
                <header class="panel-heading">
                    {{ __('افزودن بلاگ جدید') }}
                </header>
                <div class="panel-body">
                    <div class="form">
                        <form  method="post" action="{{ route('blog.store') }}" enctype="multipart/form-data" class="cmxform form-horizontal tasi-form" id="signupForm">
                            @csrf
                            <div class="form-group ">
                                <label for="title" class="control-label col-lg-2">عنوان</label>
                                <div class="col-lg-10">
                                    <input id="title" name="title" type="text" value="{{old('title')}}" class="form-control @error('title') error @enderror" />
                                    @error('title')
                                    <label for="title" class="error">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-2" for="category_id">دسته بندی</label>
                                <div class="col-lg-10">
                                    <select class="form-control m-bot15" name="category_id" id="category_id">
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="image" class="control-label col-lg-2">تصویر</label>
                                <div class="col-lg-10">
                                    <input id="image" name="image" type="file" value="{{old('image')}}" class="form-control @error('image') error @enderror" />
                                    @error('image')
                                    <label for="image" class="error">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="tags" class="control-label col-lg-2">تگ ها</label>
                                <div class="col-lg-10">
                                    <input name="tags" id="tags" class="tagsinput" value="" />
                                    @error('tags')
                                    <label for="tags" class="error">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="body" class="control-label col-lg-2">متن</label>
                                <div class="col-lg-10">

                                    <ck-editor :tag_name="{{  json_encode('body') }}" ></ck-editor>

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

    @push('scripts')
        <script src="/admin/js/jquery.tagsinput.js"></script>
        <script src="/admin/js/form-component.js"></script>
    @endpush

@endsection

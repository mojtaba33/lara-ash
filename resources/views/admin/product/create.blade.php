@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">

            <x-admin-alert :message="'message'" status="عملیات موفق" type="success" ></x-admin-alert>

            <section class="panel">
                <header class="panel-heading">
                    {{ __('افزودن محصول جدید') }}
                </header>
                <div class="panel-body">
                    <div class="form">
                        <form  method="post" action="{{ route('product.store') }}" enctype="multipart/form-data" class="cmxform form-horizontal tasi-form" id="signupForm">
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

                            <div class="form-group ">
                                <label for="brand" class="control-label col-lg-2">برند</label>
                                <div class="col-lg-10">
                                    <input id="brand" name="brand" type="text" value="{{old('brand')}}" class="form-control @error('brand') error @enderror" />
                                    @error('brand')
                                    <label for="brand" class="error">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="price" class="control-label col-lg-2">قیمت</label>
                                <div class="col-lg-10 input-group m-bot15">
                                    <input id="price" name="price" type="text" value="{{old('price')}}" class="form-control @error('price') error @enderror" />
                                    <span class="input-group-addon">تومان</span>
                                    @error('price')
                                    <label for="price" class="error">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="discount" class="control-label col-lg-2">تخفیف</label>
                                <div class="col-lg-10 input-group m-bot15">
                                    <input id="discount" name="discount" type="text" value="{{old('discount')}}" class="form-control @error('discount') error @enderror" />
                                    <span class="input-group-addon">%</span>
                                    @error('discount')
                                    <label for="discount" class="error">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="count" class="control-label col-lg-2">تعداد</label>
                                <div class="col-lg-10">
                                    <input id="count" name="count" type="text" value="{{old('count')}}" class="form-control @error('count') error @enderror" />
                                    @error('count')
                                    <label for="count" class="error">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="color" class="control-label col-lg-2">رنگ</label>
                                <div class="col-lg-10">
                                    <input name="color" id="color" class="tagsinput" value="" />
                                    @error('color')
                                    <label for="color" class="error">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="size" class="control-label col-lg-2">سایز</label>
                                <div class="col-lg-10">
{{--
                                    <input name="size" id="size" class="tagsinput" value="" />
--}}
                                    <select class="form-control m-bot15" name="size[]" id="size" multiple>
                                        <option value="'xxs'">xxs</option>
                                        <option value="'xs'">xs</option>
                                        <option value="'xss'">xss</option>
                                        <option value="'s'">s</option>
                                        <option value="'m'">m</option>
                                        <option value="'ml'">ml</option>
                                        <option value="'l'">l</option>
                                        <option value="'xl'">xl</option>
                                    </select>
                                    @error('size')
                                    <label for="size" class="error">{{ $message }}</label>
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

                            <div class="form-group">
                                <label class="control-label col-lg-2" for="status">وضعیت</label>
                                <div class="col-lg-10">
                                    <select class="form-control m-bot15" name="status" id="status">
                                        <option value="1"> فعال </option>
                                        <option value="0"> غیرفعال </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <div class="checkbox">
                                        <label>
                                            <input id="top_offer" type="checkbox" name="top_offer">
                                            پیشنهاد ویژه
                                        </label>
                                        @error('top_offer')
                                        <label for="top_offer" class="error">{{ $message }}</label>
                                        @enderror
                                    </div>
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
                                <label for="description" class="control-label col-lg-2">توضیحات</label>
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

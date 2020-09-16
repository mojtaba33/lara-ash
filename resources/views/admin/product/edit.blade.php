@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">

            <x-admin-alert :message="'message'" status="عملیات موفق" type="success" ></x-admin-alert>

            <section class="panel">
                <header class="panel-heading">
                    {{ __(' ویرایش محصول ' . $product->title ) }}
                </header>
                <div class="panel-body">
                    <div class="form">
                        <form  method="post" action="{{ route('product.update' , $product) }}" enctype="multipart/form-data" class="cmxform form-horizontal tasi-form" id="signupForm">
                            @csrf
                            @method('patch')
                            <div class="form-group ">
                                <label for="title" class="control-label col-lg-2">عنوان</label>
                                <div class="col-lg-10">
                                    <input id="title" name="title" type="text" value="{{ $product->title }}" class="form-control @error('title') error @enderror" />
                                    @error('title')
                                    <label for="title" class="error">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="brand" class="control-label col-lg-2">برند</label>
                                <div class="col-lg-10">
                                    <input id="brand" name="brand" type="text" value="{{ $product->brand }}" class="form-control @error('brand') error @enderror" />
                                    @error('brand')
                                    <label for="brand" class="error">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="price" class="control-label col-lg-2">قیمت</label>
                                <div class="col-lg-10 input-group m-bot15">
                                    <input id="price" name="price" type="text" value="{{$product->price}}" class="form-control @error('price') error @enderror" />
                                    <span class="input-group-addon">تومان</span>
                                    @error('price')
                                    <label for="price" class="error">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="discount" class="control-label col-lg-2">تخفیف</label>
                                <div class="col-lg-10 input-group m-bot15">
                                    <input id="discount" name="discount" type="text" value="{{$product->discount}}" class="form-control @error('discount') error @enderror" />
                                    <span class="input-group-addon">%</span>
                                    @error('discount')
                                    <label for="discount" class="error">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="count" class="control-label col-lg-2">تعداد</label>
                                <div class="col-lg-10">
                                    <input id="count" name="count" type="text" value="{{$product->count}}" class="form-control @error('count') error @enderror" />
                                    @error('count')
                                    <label for="count" class="error">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="color" class="control-label col-lg-2">رنگ</label>
                                <div class="col-lg-10">
                                    <input name="color" id="color" class="tagsinput" value="{{ $product->color }}" />
                                    @error('color')
                                    <label for="color" class="error">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="size" class="control-label col-lg-2">سایز</label>
                                <div class="col-lg-10">
                                    <select class="form-control m-bot15" name="size[]" id="size" multiple>
                                        <option {{ $product->hasSize('xxs') ? 'selected' : '' }} value="'xxs'">xxs</option>
                                        <option {{ $product->hasSize('xs') ? 'selected' : '' }} value="'xs'">xs</option>
                                        <option {{ $product->hasSize('xss') ? 'selected' : '' }} value="'xss'">xss</option>
                                        <option {{ $product->hasSize('s') ? 'selected' : '' }} value="'s'">s</option>
                                        <option {{ $product->hasSize('m') ? 'selected' : '' }} value="'m'">m</option>
                                        <option {{ $product->hasSize('ml') ? 'selected' : '' }} value="'ml'">ml</option>
                                        <option {{ $product->hasSize('l') ? 'selected' : '' }} value="'l'">l</option>
                                        <option {{ $product->hasSize('xl') ? 'selected' : '' }} value="'xl'">xl</option>
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
                                            <option value="{{ $cat->id }}" {{ $cat->id == $product->category_id ? 'selected' : '' }}>{{ $cat->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-2" for="status">وضعیت</label>
                                <div class="col-lg-10">
                                    <select class="form-control m-bot15" name="status" id="status">
                                        <option value="1" {{ $product->status == 1 ? 'selected' : '' }}> فعال </option>
                                        <option value="0" {{ $product->status == 0 ? 'selected' : '' }}> غیرفعال </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <div class="checkbox">
                                        <label>
                                            <input id="top_offer" type="checkbox" name="top_offer" {{ $product->top_offer == 1 ? 'checked' : '' }}>
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
                                    <input id="image" name="image" type="file" class="form-control @error('image') error @enderror" />
                                    @error('image')
                                    <label for="image" class="error">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="description" class="control-label col-lg-2">توضیحات</label>
                                <div class="col-lg-10">

                                    <ck-editor :tag_name="{{  json_encode('body') }}" :value="{{ json_encode($product->body)}}"></ck-editor>

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

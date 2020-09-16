@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">

            <x-admin-alert message="message" status="عملیات موفق" type="success" ></x-admin-alert>

            <section class="panel">
                <header class="panel-heading">
                    {{ __('افزودن مشخصات ' . $product->title) }}
                </header>
                <div class="panel-body">
                    <div class="form">
                        <form  method="post" action="{{ route('product.addOption',$product) }}" enctype="multipart/form-data" class="cmxform form-horizontal tasi-form" id="signupForm">
                            @csrf
                            @foreach($filters as $filter)
                            <h3>{{ $filter->title }}</h3>
                                @foreach($filter->children()->get() as $child)

                                    <div class="form-group ">
                                        <label for="title" class="control-label col-lg-2">{{ $child->title }}</label>
                                        <div class="col-lg-10">
                                            <input id="title" name="{{ $child->id }}" type="text" value="{{ isset($child->products()->find($product->id)->pivot->value) ? $child->products()->find($product->id)->pivot->value :  old($child->title)}}" class="form-control @error('{{ $child->id }}') error @enderror" />
                                            @error('{{ $child->id }}')
                                                <label for="title" class="error">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>

                                @endforeach
                            @endforeach

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

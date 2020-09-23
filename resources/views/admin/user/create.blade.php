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
                    {{ __('افزودن دسته بندی جدید') }}
                </header>
                <div class="panel-body">
                    <div class="form">
                        <form  method="post" action="{{ route('category.store') }}" class="cmxform form-horizontal tasi-form" id="signupForm">
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
                                <label class="control-label col-lg-2" for="parent_id">سرگروه</label>
                                <div class="col-lg-10">
                                    <select class="form-control m-bot15" name="parent_id" id="parent_id">
                                        <option value="0">سرگروه</option>
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

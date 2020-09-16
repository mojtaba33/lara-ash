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
                    {{ __(' افزودن فیلتر به دسته بندی ' . $category->title) }}
                </header>
                <div class="panel-body">
                    <div class="form">
                        <div class="cmxform form-horizontal tasi-form" id="signupForm">

                            {{--<div class="form-group ">
                                <label for="title" class="control-label col-lg-2">عنوان</label>
                                <div class="col-lg-10">
                                    <input disabled value="{{ $category->title }}" class="form-control @error('title') error @enderror" />
                                </div>
                            </div>--}}

                            <filter-add :category_id="{{ $category->id }}"></filter-add>

                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    @push('header-script')
        <link rel="stylesheet" href="/admin/css/iziToast.min.css">
        <script src="/admin/js/iziToast.min.js"></script>
    @endpush
@endsection

@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">

            <x-admin-alert :message="'message'" status="عملیات موفق" type="success" ></x-admin-alert>

            <section class="panel">
                <header class="panel-heading">
                    {{ __('افزودن خدمات جدید') }}
                </header>
                <div class="panel-body">
                    <div class="form">
                        <form  method="post" action="{{ route('service.store') }}" enctype="multipart/form-data" class="cmxform form-horizontal tasi-form" id="signupForm">
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
                                <label for="label" class="control-label col-lg-2">توضیح</label>
                                <div class="col-lg-10">
                                    <input id="label" name="label" type="text" value="{{old('label')}}" class="form-control @error('label') error @enderror" />
                                    @error('label')
                                    <label for="label" class="error">{{ $message }}</label>
                                    @enderror
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
        <script>
            $(document).ready(function () {
                $("#holder_input").hide();
                $('#show').change(function() {
                    // this will contain a reference to the checkbox
                    if (this.checked) {
                        $("#holder_input").show();
                        $( "#position" ).prop( "disabled", false );
                        $( "#description" ).prop( "disabled", false );
                    } else {
                        $("#holder_input").hide();
                        $( "#position" ).prop( "disabled", true );
                        $( "#description" ).prop( "disabled", true );
                    }
                });
            });
        </script>
    @endpush

@endsection

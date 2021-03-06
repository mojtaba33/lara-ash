@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">

            <x-admin-alert :message="'message'" status="عملیات موفق" type="success" ></x-admin-alert>

            <section class="panel">
                <header class="panel-heading">
                    {{ __('   ویرایش بنر  ' . $banner->title ) }}
                </header>
                <div class="panel-body">
                    <div class="form">
                        <form  method="post" action="{{ route('banner.update',$banner) }}" enctype="multipart/form-data" class="cmxform form-horizontal tasi-form" id="signupForm">
                            @csrf
                            @method('patch')
                            <div class="form-group ">
                                <label for="title" class="control-label col-lg-2">عنوان</label>
                                <div class="col-lg-10">
                                    <input id="title" name="title" type="text" value="{{$banner->title}}" class="form-control @error('title') error @enderror" />
                                    @error('title')
                                    <label for="title" class="error">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="title" class="control-label col-lg-2">آدرس</label>
                                <div class="col-lg-10">
                                    <input id="url" name="url" type="text" value="{{$banner->url}}" class="form-control @error('url') error @enderror" />
                                    @error('url')
                                    <label for="url" class="error">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <div class="checkbox">
                                        <label>
                                            <input id="show" type="checkbox" name="show" {{ $banner->show ? 'checked' : '' }}>
                                            نمایش در صفحه ی اصلی
                                        </label>
                                        @error('show')
                                        <label for="title" class="error">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div id="holder_input" style="margin-bottom: 30px;">

                                <div class="form-group ">
                                    <label for="image" class="control-label col-lg-2">تصویر</label>
                                    <div class="col-lg-10">
                                        <input id="image" name="image" type="file" value="{{$banner->image}}" class="form-control @error('image') error @enderror" />
                                        @error('image')
                                        <label for="image" class="error">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-2" for="position">مکان</label>
                                    <div class="col-lg-10">
                                        <select class="form-control m-bot15" name="position" id="position" disabled>
                                            <option value="left" {{ $banner->position == 'left' ? 'selected' : '' }}>عکس بزرگ سمت چپ صفحه ی اصلی</option>
                                            <option value="right" {{ $banner->position == 'right' ? 'selected' : '' }}>عکس های سمت راست صفحه ی اصلی</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="description" class="control-label col-lg-2">توضیحات</label>
                                    <div class="col-lg-10">

                                        <ck-editor :tag_name="{{ json_encode('description') }}" :value="{{ json_encode( $banner->description ) }}" ></ck-editor>

                                    </div>
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

                var checkbox = document.getElementById('show');
                if (checkbox.checked) {
                    $("#holder_input").show();
                    $( "#position" ).prop( "disabled", false );
                    $( "#description" ).prop( "disabled", false );
                } else {
                    $("#holder_input").hide();
                    $( "#position" ).prop( "disabled", true );
                    $( "#description" ).prop( "disabled", true );
                }

                //$("#holder_input").hide();
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

@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <p class=" text text-info">{{ __(' گالری محصول  ' . $product->title)  }}</p>
            <div class="panel-body">
                <div class="form">
                    <form action="{{route('product.store.gallery',$product)}}" method="post" class="dropzone"  enctype="multipart/form-data">
                        @csrf
                        <div class="fallback">
                            <input name="file" type="file" multiple />
                        </div>
                    </form>
                </div>
            </div>
            <div style="display:flex">
                @foreach($galleries as $gallery)
                    <form action="{{ route('product.destroy.gallery',$gallery) }} }}" method="post" style="position: relative;margin-left: 20px;">
                        @csrf
                        @method('delete')
                        <img src="{{ url($gallery->image[125]) }}" alt="" height="100">
                        <button type="submit" style="color: #fff;z-index: 1000;background-color: red;border-radius: 50%;cursor: pointer;position: absolute;right: 0;border: none;padding: 0px 2px;">
                            <i class="icon-remove" style=""></i>
                        </button>
                    </form>
                @endforeach
            </div>
        </div>

    </div>

    @push('header-script')
        <link rel="stylesheet" href="/admin/css/dropzone.min.css">
        <script src="/admin/js/dropzone.min.js"></script>
    @endpush


@endsection

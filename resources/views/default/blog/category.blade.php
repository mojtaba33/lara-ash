@extends('default.layouts.master')
@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{ url('/') }}"><i class="fa fa-home"></i> Home</a>
                        <span>Blog</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
    <!-- Blog Section Begin -->
    <section class="blog spad">
        <div class="container">
            @if($blogs->isNotEmpty())
            <div class="row">
                @foreach($blogs->chunk(3) as $chunk)
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        @foreach($chunk as $blog)
                            <div class="blog__item">
                                <div class="blog__item__pic set-bg" data-setbg="{{ url($blog->image) }}"></div>
                                <div class="blog__item__text">
                                    <h6>
                                        <a href="{{ $blog->path() }}">{{ Str::limit($blog->title , 100) }}</a>
                                    </h6>
                                    <ul>
                                        <li>by <span>{{ $blog->user->name }}</span></li>
                                        <li>{{ (new \Carbon\Carbon($blog->created_at))->toFormattedDateString() }}</li>
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach

                <div class="col-lg-12 text-center">
                    {{ $blogs->links() }}
                </div>
            </div>
            @else
                <div class="row">
                    <div style="text-align: center;margin: 20px auto;">
                        there is nothing to show
                    </div>
                </div>
            @endif
        </div>
    </section>
    <!-- Blog Section End -->
@endsection
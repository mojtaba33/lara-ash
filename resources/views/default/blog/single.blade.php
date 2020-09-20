@extends('default.layouts.master')
@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{ url('/') }}"><i class="fa fa-home"></i> Home</a>
                        <a href="{{ route('blog.all') }}">Blog</a>
                        <span>{{ $blog->title }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Blog Details Section Begin -->
    <section class="blog-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <div class="blog__details__content">
                        <div class="blog__details__item">
                            <img src="{{ url($blog->image) }}" alt="">
                            <div class="blog__details__item__title">
                                <span class="tip">Street style</span>
                                <h4>{{ $blog->title }}</h4>
                                <ul>
                                    <li>by <span>{{ $blog->user->name }}</span></li>
                                    <li>{{ (new \Carbon\Carbon($blog->created_at))->toFormattedDateString() }}</li>
                                    <li>39 Comments</li>
                                </ul>
                            </div>
                        </div>
                        <div class="blog__details__desc">
                            {!! $blog->body !!}
                        </div>
                        <div class="blog__details__tags">
                            @foreach(explode(',',$blog->tags) as $tag)
                                <a href="{{ route('blog.tag',['tag' => $tag]) }}">{{ $tag }}</a>
                            @endforeach
                        </div>
                        <div class="blog__details__btns">
                            <div class="row">
                                @if($previous)
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="blog__details__btn__item">
                                        <h6><a href="{{ route('blog.single',$previous) }}"><i class="fa fa-angle-left"></i> Previous posts</a></h6>
                                    </div>
                                </div>
                                @endif
                                @if($next)
                                <div class="col-lg-6 col-md-6 col-sm-6 {{ $previous == null ? 'offset-md-6' : '' }}">
                                    <div class="blog__details__btn__item blog__details__btn__item--next  ">
                                        <h6><a href="{{ route('blog.single',$next) }}">Next posts <i class="fa fa-angle-right"></i></a></h6>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="blog__details__comment">
                            <h5>3 Comment</h5>
                            <a href="#" class="leave-btn">Leave a comment</a>
                            <div class="blog__comment__item">
                                <div class="blog__comment__item__pic">
                                    <img src="img/blog/details/comment-1.jpg" alt="">
                                </div>
                                <div class="blog__comment__item__text">
                                    <h6>Brandon Kelley</h6>
                                    <p>Duis voluptatum. Id vis consequat consetetur dissentiet, ceteros commune perpetua
                                        mei et. Simul viderer facilisis egimus tractatos splendi.</p>
                                    <ul>
                                        <li><i class="fa fa-clock-o"></i> Seb 17, 2019</li>
                                        <li><i class="fa fa-heart-o"></i> 12</li>
                                        <li><i class="fa fa-share"></i> 1</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="blog__comment__item blog__comment__item--reply">
                                <div class="blog__comment__item__pic">
                                    <img src="img/blog/details/comment-2.jpg" alt="">
                                </div>
                                <div class="blog__comment__item__text">
                                    <h6>Brandon Kelley</h6>
                                    <p>Consequat consetetur dissentiet, ceteros commune perpetua mei et. Simul viderer
                                        facilisis egimus ulla mcorper.</p>
                                    <ul>
                                        <li><i class="fa fa-clock-o"></i> Seb 17, 2019</li>
                                        <li><i class="fa fa-heart-o"></i> 12</li>
                                        <li><i class="fa fa-share"></i> 1</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="blog__comment__item">
                                <div class="blog__comment__item__pic">
                                    <img src="img/blog/details/comment-3.jpg" alt="">
                                </div>
                                <div class="blog__comment__item__text">
                                    <h6>Brandon Kelley</h6>
                                    <p>Duis voluptatum. Id vis consequat consetetur dissentiet, ceteros commune perpetua
                                        mei et. Simul viderer facilisis egimus tractatos splendi.</p>
                                    <ul>
                                        <li><i class="fa fa-clock-o"></i> Seb 17, 2019</li>
                                        <li><i class="fa fa-heart-o"></i> 12</li>
                                        <li><i class="fa fa-share"></i> 1</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="blog__sidebar">
                        <div class="blog__sidebar__item">
                            <div class="section-title">
                                <h4>Categories</h4>
                            </div>
                            <ul>
                                @foreach($categories as $category)
                                <li>
                                    <a href="{{ route('blog.category',$category) }}">{{ $category->title }} <span>({{ $category->blogs->count() }})</span></a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="blog__sidebar__item">
                            <div class="section-title">
                                <h4>Feature posts</h4>
                            </div>
                            @foreach($related as $blg)
                            <a href="#" class="blog__feature__item">
                                <div class="blog__feature__item__pic">
                                    <img src="{{ url($blg->image) }}" style="width: 100px;" alt="">
                                </div>
                                <div class="blog__feature__item__text">
                                    <h6>{{ Str::limit($blg->title , 50) }}</h6>
                                    <span>{{ (new \Carbon\Carbon($blog->created_at))->toFormattedDateString() }}</span>
                                </div>
                            </a>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Section End -->
@endsection
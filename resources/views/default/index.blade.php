@extends('default.layouts.master')
@section('content')
    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 p-0">
                    <div class="categories__item categories__large__item set-bg"
                         data-setbg="{{ $leftBanner->image }}">
                        <div class="categories__text">
                            <h1>{{ $leftBanner->title }}</h1>
                            <p>{!! $leftBanner->description !!}</p>
                            <a href="{{ $leftBanner->url }}">Shop now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        @foreach($rightBanners as $rightBanner)
                        <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                            <div class="categories__item set-bg" data-setbg="{{ $rightBanner->image }}">
                                <div class="categories__text">
                                    <h4>{{ $rightBanner->title }}</h4>
                                    <p>{!! $rightBanner->description !!}</p>
                                    <a href="{{ $rightBanner->url }}">Shop now</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->



    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="related__title">
                    <h5>SALE OFF PRODUCTS</h5>
                </div>
            </div>

            <div class="sale_off owl-carousel">
                @foreach($topOfferProducts as $topOfferProduct)
                    <div class="">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="{{ url($topOfferProduct->image[360]) }}">
                                <ul class="product__hover">
                                    <li><a href="{{ url($topOfferProduct->image['original']) }}" class="image-popup"><span class="arrow_expand"></span></a></li>
                                    <li><a href="{{ route('add.to.fav',$topOfferProduct) }}"><span class="icon_heart_alt"></span></a></li>
                                    <li><a href="{{ $topOfferProduct->path() }}"><span class="icon_bag_alt"></span></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="{{ $topOfferProduct->path() }}">{{ $topOfferProduct->title }}</a></h6>

                                @if($topOfferProduct->getProductRate() != 0)
                                    <div class="rating">
                                        @for($i=1; $i<=$topOfferProduct->getProductRate() ; $i++)
                                            <i class="fa fa-star"></i>
                                        @endfor
                                        @for($i=5; $i > $topOfferProduct->getProductRate(); $i--)
                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                        @endfor
                                    </div>
                                @else
                                    <div class="rating">
                                        @for($i=1;$i<=5;$i++)
                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                        @endfor
                                    </div>
                                @endif
                                <div class="product__price">
                                    $ {{ $topOfferProduct->discount == 0 ? $topOfferProduct->price : $topOfferProduct->price - ( $topOfferProduct->price * $topOfferProduct->discount ) / 100  }}
                                </div>
                            </div>
                        </div>
                        <div class="discount__countdown countdown-time">
                            {{--<div class="countdown__item">
                                <span style="font-size: 14px">22</span>
                                <p>Days</p>
                            </div>--}}
                            <div class="countdown__item">
                                <span style="font-size: 14px">2</span>
                                <p>Hour</p>
                            </div>
                            <div class="countdown__item">
                                <span style="font-size: 14px">00</span>
                                <p>Min</p>
                            </div>
                            <div class="countdown__item">
                                <span style="font-size: 14px">60</span>
                                <p>Sec</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>




    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="section-title">
                        <h4>New product</h4>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8">
                    <ul class="filter__controls">
                        <li class="active" data-filter="*">All</li>
                        @foreach($categories as $category)
                            <li data-filter=".{{ $category->slug }}">{{ $category->title }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="row property__gallery">
                @foreach($categories as $category)
                    @foreach($category->products()->latest()->take(4)->get() as $newProduct)
                        <div class="col-lg-3 col-md-4 col-sm-6 mix {{ $category->slug }}">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="{{ url($newProduct->image[360]) }}">
                                    <ul class="product__hover">
                                        <li><a href="{{ url($newProduct->image['original']) }}" class="image-popup"><span class="arrow_expand"></span></a></li>
                                        <li>
                                            <a href="{{ route('add.to.fav',$newProduct) }}"><span class="icon_heart_alt"></span></a>
                                        </li>
                                        <li><a href="{{ $newProduct->path() }}"><span class="icon_bag_alt"></span></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="{{ $newProduct->path() }}">{{ $newProduct->title }}</a></h6>
                                    @if($newProduct->getProductRate() != 0)
                                        <div class="rating">
                                            @for($i=1; $i<=$newProduct->getProductRate() ; $i++)
                                                <i class="fa fa-star"></i>
                                            @endfor
                                            @for($i=5; $i > $newProduct->getProductRate(); $i--)
                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                            @endfor
                                        </div>
                                    @else
                                        <div class="rating">
                                            {{--@for($i=1;$i<=5;$i++)
                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                            @endfor--}}
                                        </div>
                                    @endif
                                    <div class="product__price">
                                        $ {{ $newProduct->discount == 0 ? $newProduct->price : $newProduct->price - ( $newProduct->price * $newProduct->discount ) / 100  }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </section>
    <!-- Product Section End -->

    <!-- Banner Section Begin -->
    <section class="banner set-bg" data-setbg="/default/img/banner/banner-1.jpg">
        <div class="container">
            <div class="row">
                <div class="col-xl-7 col-lg-8 m-auto">
                    <div class="banner__slider owl-carousel">
                        @foreach($sliders as $slider)
                        <div class="banner__item">
                            <div class="banner__text">
                                <span>{{ $slider->label }}</span>
                                <h1>{{ $slider->title }}</h1>
                                <a href="{{ $slider->url }}">Shop now</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Section End -->

    <!-- Trend Section Begin -->
    <section class="trend spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="trend__content">
                        <div class="section-title">
                            <h4>Hot Trend</h4>
                        </div>
                        @foreach($hotTrendProducts as $hotTrendProduct)
                        <div class="trend__item">
                            <div class="trend__item__pic">
                                <img src="{{ url($hotTrendProduct->image[90]) }}" alt="">
                            </div>
                            <div class="trend__item__text">
                                <h6><a href="{{ $hotTrendProduct->path() }}" style="font-size: 14px;color: #111111;margin-bottom: 5px;">{{ $hotTrendProduct->title }}</a></h6>
                                @if($hotTrendProduct->getProductRate() != 0)
                                    <div class="rating">
                                        @for($i=1; $i<=$hotTrendProduct->getProductRate() ; $i++)
                                            <i class="fa fa-star"></i>
                                        @endfor
                                        @for($i=5; $i > $hotTrendProduct->getProductRate(); $i--)
                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                        @endfor
                                    </div>
                                @else
                                    <div class="rating">
                                        @for($i=1;$i<=5;$i++)
                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                        @endfor
                                    </div>
                                @endif
                                <div class="product__price">
                                    $ {{ $hotTrendProduct->discount == 0 ? $hotTrendProduct->price : $hotTrendProduct->price - ( $hotTrendProduct->price * $hotTrendProduct->discount ) / 100  }}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="trend__content">
                        <div class="section-title">
                            <h4>Best seller</h4>
                        </div>
                        @foreach($bestSellerProducts as $bestSellerProducts)
                        <div class="trend__item">
                            <div class="trend__item__pic">
                                <img src="{{ url($bestSellerProducts->image[90]) }}" alt="">
                            </div>
                            <div class="trend__item__text">
                                <h6><a href="{{ $bestSellerProducts->path() }}" style="font-size: 14px;color: #111111;margin-bottom: 5px;">{{ $bestSellerProducts->title }}</a></h6>
                                @if($bestSellerProducts->getProductRate() != 0)
                                    <div class="rating">
                                        @for($i=1; $i<=$bestSellerProducts->getProductRate() ; $i++)
                                            <i class="fa fa-star"></i>
                                        @endfor
                                        @for($i=5; $i > $bestSellerProducts->getProductRate(); $i--)
                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                        @endfor
                                    </div>
                                @else
                                    <div class="rating">
                                        @for($i=1;$i<=5;$i++)
                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                        @endfor
                                    </div>
                                @endif
                                <div class="product__price">
                                    $ {{ $bestSellerProducts->discount == 0 ? $bestSellerProducts->price : $bestSellerProducts->price - ( $bestSellerProducts->price * $bestSellerProducts->discount ) / 100  }}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="trend__content">
                        <div class="section-title">
                            <h4>Feature</h4>
                        </div>
                        @foreach($features as $feature)
                            <div class="trend__item">
                                <div class="trend__item__pic">
                                    <img src="{{ url($feature->image[90]) }}" alt="">
                                </div>
                                <div class="trend__item__text">
                                    <h6><a href="{{ $feature->path() }}" style="font-size: 14px;color: #111111;margin-bottom: 5px;">{{ $feature->title }}</a></h6>
                                    @if($feature->getProductRate() != 0)
                                        <div class="rating">
                                            @for($i=1; $i<=$feature->getProductRate() ; $i++)
                                                <i class="fa fa-star"></i>
                                            @endfor
                                            @for($i=5; $i > $feature->getProductRate(); $i--)
                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                            @endfor
                                        </div>
                                    @else
                                        <div class="rating">
                                            @for($i=1;$i<=5;$i++)
                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                            @endfor
                                        </div>
                                    @endif
                                    <div class="product__price">
                                        $ {{ $feature->discount == 0 ? $feature->price : $feature->price - ( $feature->price * $feature->discount ) / 100  }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Trend Section End -->

    <!-- Discount Section Begin -->
    {{--<section class="discount">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 p-0">
                    <div class="discount__pic">
                        <img src="/default/img/discount.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-6 p-0">
                    <div class="discount__text">
                        <div class="discount__text__title">
                            <span>Discount</span>
                            <h2>Summer 2019</h2>
                            <h5><span>Sale</span> 50%</h5>
                        </div>
                        <div class="discount__countdown" id="countdown-time">
                            <div class="countdown__item">
                                <span>22</span>
                                <p>Days</p>
                            </div>
                            <div class="countdown__item">
                                <span>18</span>
                                <p>Hour</p>
                            </div>
                            <div class="countdown__item">
                                <span>46</span>
                                <p>Min</p>
                            </div>
                            <div class="countdown__item">
                                <span>05</span>
                                <p>Sec</p>
                            </div>
                        </div>
                        <a href="/default/#">Shop now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>--}}
    <!-- Discount Section End -->

    <!-- Services Section Begin -->
    <section class="services spad">
        <div class="container">
            <div class="row">
                @foreach($services as $service)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="services__item">
                        {{--<i class="fa fa-car"></i>--}}
                        <img src="{{ url($service->image) }}" style="position: absolute;left: 0;top: 4px;height:30px">
                        <h6>{{ $service->title }}</h6>
                        <p>{{ $service->label }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Services Section End -->
    @push('scripts')
    @if(session()->has('message'))
        <script>
            iziToast.show({
                title: " {{ session('title') }} ",
                message: "{{ session('message') }}",
                rtl: false,
                color: "{{ session('color') }}",
            });

        </script>
    @endif
    @endpush
@endsection
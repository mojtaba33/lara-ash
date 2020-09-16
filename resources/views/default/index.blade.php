@extends('default.layouts.master')
@section('content')
    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 p-0">
                    <div class="categories__item categories__large__item set-bg"
                         data-setbg="{{ $leftCategory->image }}">
                        <div class="categories__text">
                            <h1>{{ $leftCategory->title }}</h1>
                            <p>{!! $leftCategory->description !!}</p>
                            <p>{{ $leftCategory->getProducts()->count() }} items</p>
                            <a href="{{ $leftCategory->path() }}">Shop now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        @foreach($rightCategories as $rightCategory)
                        <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                            <div class="categories__item set-bg" data-setbg="{{ $rightCategory->image }}">
                                <div class="categories__text">
                                    <h4>{{ $rightCategory->title }}</h4>
                                    <p>{!! $rightCategory->description !!}</p>
                                    <p>{{ $rightCategory->getProducts()->count() }} items</p>
                                    <a href="{{ $rightCategory->path() }}">Shop now</a>
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
                @foreach($newProducts as $newProduct)
                <div class="col-lg-3 col-md-4 col-sm-6 mix {{ $newProduct->category->parent->slug }}">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="{{ url($newProduct->image[360]) }}">
                            <ul class="product__hover">
                                <li><a href="{{ url($newProduct->image['original']) }}" class="image-popup"><span class="arrow_expand"></span></a></li>
                                <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                <li><a href="#"><span class="icon_bag_alt"></span></a></li>
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
                                    @for($i=1;$i<=5;$i++)
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                    @endfor
                                </div>
                            @endif
                            <div class="product__price">
                                $ {{ $newProduct->discount == 0 ? $newProduct->price : $newProduct->price - ( $newProduct->price * $newProduct->discount ) / 100  }}
                            </div>
                        </div>
                    </div>
                </div>
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
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
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
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
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
                        @foreach($topOfferProducts as $topOfferProduct)
                            <div class="trend__item">
                                <div class="trend__item__pic">
                                    <img src="{{ url($topOfferProduct->image[90]) }}" alt="">
                                </div>
                                <div class="trend__item__text">
                                    <h6><a href="{{ $topOfferProduct->path() }}" style="font-size: 14px;color: #111111;margin-bottom: 5px;">{{ $topOfferProduct->title }}</a></h6>
                                    <div class="rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="product__price">
                                        $ {{ $topOfferProduct->discount == 0 ? $topOfferProduct->price : $topOfferProduct->price - ( $topOfferProduct->price * $topOfferProduct->discount ) / 100  }}
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
    <section class="discount">
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
    </section>
    <!-- Discount Section End -->

    <!-- Services Section Begin -->
    <section class="services spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="services__item">
                        <i class="fa fa-car"></i>
                        <h6>Free Shipping</h6>
                        <p>For all oder over $99</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="services__item">
                        <i class="fa fa-money"></i>
                        <h6>Money Back Guarantee</h6>
                        <p>If good have Problems</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="services__item">
                        <i class="fa fa-support"></i>
                        <h6>Online Support 24/7</h6>
                        <p>Dedicated support</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="services__item">
                        <i class="fa fa-headphones"></i>
                        <h6>Payment Secure</h6>
                        <p>100% secure payment</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Services Section End -->
@endsection
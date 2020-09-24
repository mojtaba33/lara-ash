@extends('default.layouts.master')
@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{ url('/') }}"><i class="fa fa-home"></i> Home</a>
                        <span>category</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Shop Section Begin -->
    <section class="shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="shop__sidebar">
                        <div class="sidebar__categories">
                            <div class="section-title">
                                <h4>Categories</h4>
                            </div>
                            <div class="categories__accordion">
                                <div class="accordion" id="accordionExample">
                                    @foreach($categories as $category)
                                    <div class="card">
                                        <div class="card-heading active">
                                            <a data-toggle="collapse" data-target="#collapseOne">{{ $category->title }}</a>
                                        </div>
                                        <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <ul>
                                                    @foreach($category->children as $child)
                                                    <li><a href="{{ $child->path() }}">{{ $child->title }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="sidebar__filter">
                            <div class="section-title">
                                <h4>Shop by price</h4>
                            </div>
                            <form action="" method="get">
                            <div class="filter-range-wrap">
                                <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                     data-min="20" data-max="2000"></div>
                                <div class="range-slider">
                                    <div class="price-input">
                                        <p>Price:</p>
                                        <input name="minPrice" type="text" id="minamount">
                                        <input name="maxPrice" type="text" id="maxamount">
                                    </div>
                                </div>
                            </div>

                                <input  name="item" type="hidden" value="{{ request('item') }}">

                            <div class="sidebar__sizes" id="size" style="margin-top: 50px">
                                <div class="section-title">
                                    <h5>size</h5>
                                </div>
                                <div class="size__list">
                                    <label for="xxs">
                                        xxs
                                        <input type="checkbox" id="xxs" name="xxs" {{ \request()->has('xxs') ? 'checked' : '' }}>
                                        <span class="checkmark"></span>
                                    </label>
                                    <label for="xs">
                                        xs
                                        <input type="checkbox" id="xs" name="xs" {{ \request()->has('xs') ? 'checked' : '' }}>
                                        <span class="checkmark"></span>
                                    </label>
                                    <label for="xss">
                                        xs-s
                                        <input type="checkbox" id="xss" name="xss" {{ \request()->has('xss') ? 'checked' : '' }}>
                                        <span class="checkmark"></span>
                                    </label>
                                    <label for="s">
                                        s
                                        <input type="checkbox" id="s" name="s" {{ \request()->has('s') ? 'checked' : '' }}>
                                        <span class="checkmark"></span>
                                    </label>
                                    <label for="m">
                                        m
                                        <input type="checkbox" id="m" name="m" {{ \request()->has('m') ? 'checked' : '' }}>
                                        <span class="checkmark"></span>
                                    </label>
                                    <label for="ml">
                                        m-l
                                        <input type="checkbox" id="ml" name="ml" {{ \request()->has('ml') ? 'checked' : '' }}>
                                        <span class="checkmark"></span>
                                    </label>
                                    <label for="l">
                                        l
                                        <input type="checkbox" id="l" name="l" {{ \request()->has('l') ? 'checked' : '' }}>
                                        <span class="checkmark"></span>
                                    </label>
                                    <label for="xl">
                                        xl
                                        <input type="checkbox" id="xl" name="xl" {{ \request()->has('xl') ? 'checked' : '' }}>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                             </div>

                            <button style="font-size: 14px;color: #0d0d0d;text-transform: uppercase;letter-spacing: 2px;font-weight: 700;display: inline-block;padding: 5px 16px 5px 24px;border: 2px solid #ff0000;position: absolute;right: 0;bottom: -5px;border-radius: 2px;"  type="submit">Filter</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9">
                    @if($products->isNotEmpty())
                    <div class="row">
                        @foreach($products as $product)
                        <div class="col-lg-4 col-md-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="{{ url($product->image[360]) }}">
                                    <ul class="product__hover">
                                        <li><a href="{{ url($product->image['original']) }}" class="image-popup"><span class="arrow_expand"></span></a></li>
                                        <li><a href="{{ route('add.to.fav',$product) }}"><span class="icon_heart_alt"></span></a></li>
                                        <li><a href="{{ $product->path() }}"><span class="icon_bag_alt"></span></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="{{ $product->path() }}">{{ $product->title }}</a></h6>
                                    @if($product->getProductRate() != 0)
                                        <div class="rating">
                                            @for($i=1; $i<=$product->getProductRate() ; $i++)
                                                <i class="fa fa-star"></i>
                                            @endfor
                                            @for($i=5; $i > $product->getProductRate(); $i--)
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
                                        $ {{ $product->discount == 0 ? $product->price : $product->price - ( $product->price * $product->discount ) / 100  }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="col-lg-12 text-center">
                            {{ $products->links() }}
                        </div>
                    </div>
                    @else
                        <p class="text text-center text-primary">There is nothing to show</p>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Section End -->
    @push('scripts')
        {{--<script>

            $(document).ready(function(){
                let size = [];
                $("#size input:checkbox").change(function() {
                    if($(this).is(":checked")) {
                        size.push($(this).attr("name"));
                        $.ajax({
                            url: '',
                            type: 'GET',
                            data: {
                                size : size,
                            }
                        });

                    } else {
                        var index = size.indexOf($(this).attr("name"));

                        if (index > -1) {
                            size.splice(index, 1);
                        }

                        $.ajax({
                            url: '',
                            type: 'GET',
                            data: {
                                size : size,
                            }
                        });

                    }
                });
            });


        </script>--}}
    @endpush
@endsection
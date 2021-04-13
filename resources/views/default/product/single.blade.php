@extends('default.layouts.master')
@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{ url('/') }}"><i class="fa fa-home"></i> Home</a>

                        <a href="{{ $product->category->parent->path() }}">{{ $product->category->parent->title }} </a>
                        <a href="{{ $product->category->path() }}">{{ $product->category->title }} </a>

                        <span>{{ $product->title }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__left product__thumb nice-scroll">
                            <a class="pt active" href="#product">
                                <img src="{{ url($product->image[90]) }}" alt="">
                            </a>
                            @foreach($product->galleries()->latest()->get() as $gallery)
                                <a class="pt" href='#{{ 'product-'.$gallery->id }}'>
                                    <img src="{{ url($gallery->image[125]) }}" alt="">
                                </a>
                            @endforeach
                        </div>
                        <div class="product__details__slider__content">
                            <div class="product__details__pic__slider owl-carousel">
                                <img data-hash="product" class="product__big__img" src="{{ url($product->image[420]) }}" alt="">
                                @foreach($product->galleries()->latest()->get() as $gallery)
                                    <img data-hash="{{ 'product-'.$gallery->id }}" class="product__big__img" src="{{ url($gallery->image[420]) }}" alt="">
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product__details__text">
                        <h3>{{ $product->title }} <span>Brand: {{ $product->brand }}</span></h3>

                        @if($product->getProductRate() != 0)
                            <div class="rating">
                                @for($i=1; $i<=$product->getProductRate() ; $i++)
                                    <i class="fa fa-star"></i>
                                @endfor
                                @for($i=5; $i > $product->getProductRate(); $i--)
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                @endfor
                                    <span>( {{ $product->getProductReviewCount() }} reviews )</span>
                            </div>
                        @else
                            <div class="rating">
                                @for($i=1;$i<=5;$i++)
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                @endfor
                                <span>( 0 review )</span>
                            </div>
                        @endif
                        <div class="product__details__price">$ {{ $product->discount == 0 ? $product->price : $product->price - ( $product->price * $product->discount / 100 ) }}
                            @if($product->discount != 0 )
                            <span>
                                $ {{ $product->price }}
                            </span>
                            @endif
                        </div>
                        <add-to-cart
                                :product_id="{{ json_encode($product->id) }}"
                                :url="{{ json_encode(route('add.to.cart',$product)) }}"
                                :colors = "{{ json_encode(explode(',',$product->color)) }}"
                                :sizes = "{{ json_encode(explode(',',$product->size)) }}"
                                :product = "{{ json_encode($product) }}"
                                :fav="{{ json_encode(auth()->check() ? auth()->user()->is_fav($product) : false) }}"
                        ></add-to-cart>
                        {{--<div class="product__details__widget">
                            <ul>
                                <li>
                                    <span>Availability:</span>
                                    <div class="stock__checkbox">
                                        <label for="stockin">
                                            In Stock
                                            <input type="checkbox" id="stockin">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <span>Available color:</span>

                                    <div class="color__checkbox">
                                        @foreach(explode(',',$product->color) as $key=>$color)
                                            @if($color != null)
                                                <label for="{{ $color }}">
                                                    <input type="radio" name="color" id="{{ $color }}" {{ $key==0 ? 'checked' : '' }}>
                                                    <span class="checkmark" style="background-color: {{ $color }}"></span>
                                                </label>
                                            @else
                                                <label for="{{ $color }}">
                                                    -
                                                </label>
                                            @endif
                                        @endforeach
                                    </div>

                                </li>
                                <li>
                                    <span>Available size:</span>
                                    <div class="size__btn">
                                        @foreach(explode(',',$product->size) as $key=>$size)
                                            @if($size != null)
                                                <label for="{{ $size }}" class="{{ $key==0 ? 'active' : '' }}">
                                                    <input type="radio" id="{{ $size }}">
                                                    {{ $size }}
                                                </label>
                                            @else
                                                <label for="{{ $size }}">
                                                    -
                                                </label>
                                            @endif
                                        @endforeach
                                    </div>
                                </li>
                                <li>
                                    <span>Promotions:</span>
                                    <p>Free shipping</p>
                                </li>
                            </ul>
                        </div>--}}

                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-4" role="tab">Specifications</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Add Review</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Reviews ( {{ $comments->count() }} )</a>
                            </li>

                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <h6>Description</h6>
                                {!! $product->body !!}
                            </div>
                            <div class="tab-pane" id="tabs-4" role="tabpanel">
                                <h6>Specifications</h6>
                                <table class="table">
                                    <tbody>
                                        @foreach($product->category->filters()->where('parent_id',0)->get() as $filter)
                                            <tr>
                                                <th colspan="2">{{ $filter->title }}</th>
                                            </tr>
                                            @foreach($filter->children()->with('products')->get() as $child)
                                            <tr>
                                                <td>{{ $child->title }}</td>
                                                <td>{{ isset($child->products()->find($product->id)->pivot->value) ? $child->products()->find($product->id)->pivot->value :  '-' }}</td>
                                            </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <h6>Add Review</h6>
                                <div class="row justify-content-md-center">

                                    <div class="col-6">

                                        @if(auth()->check())
                                            <form method="post" action="{{ route('add.comment') }}" >
                                            @csrf
                                            <input type="hidden" name="commentable_id" id="product_id" value="{{ $product->id }}">
                                            <input type="hidden" name="commentable_type" id="product_id" value="{{ get_class($product) }}">
                                            <input type="hidden" name="parent_id" id="parent_id" value="0">

                                            <div class="form-group">
                                                <label for="body">Review</label>
                                                <textarea class="form-control" name="body" id="body" rows="4"></textarea>
                                                @error('body')
                                                <label for="title" class="error">{{ $message }}</label>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="add-rating-css" class="mr-5">Score</label>
                                                <select id="add-rating-css" name="rate">
                                                    <option value="0">0</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                                @error('rating')
                                                <label for="title" class="error">{{ $message }}</label>
                                                @enderror
                                            </div>
                                                <button type="submit" class="btn btn-primary">Send</button>
                                        </form>
                                        @else
                                            <p class="text text-danger text-center">
                                                to post a review you must first log in .
                                            </p>
                                        @endif
                                    </div>

                                </div>

                            </div>
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <h6>Reviews ( {{ $comments->count() }} )</h6>
                                <div class=" bootstrap snippets bootdey">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="blog-comment">
                                                <hr/>

                                                <x-comments :comments="$comments"></x-comments>

                                                {{ $comments->links() }}

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="related__title">
                        <h5>RELATED PRODUCTS</h5>
                    </div>
                </div>
                @foreach($relatedProducts as $relatedProduct)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="{{ url($relatedProduct->image[360]) }}">
                            <ul class="product__hover">
                                <li><a href="{{ url($relatedProduct->image['original']) }}" class="image-popup"><span class="arrow_expand"></span></a></li>
                                <li><a href="{{ route('add.to.fav',$relatedProduct) }}"><span class="icon_heart_alt"></span></a></li>
                                <li><a href="{{ $relatedProduct->path() }}"><span class="icon_bag_alt"></span></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="{{ $relatedProduct->path() }}">{{ $relatedProduct->title }}</a></h6>

                            @if($relatedProduct->getProductRate() != 0)
                                <div class="rating">
                                    @for($i=1; $i<=$relatedProduct->getProductRate() ; $i++)
                                        <i class="fa fa-star"></i>
                                    @endfor
                                    @for($i=5; $i > $relatedProduct->getProductRate(); $i--)
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
                                $ {{ $relatedProduct->discount == 0 ? $relatedProduct->price : $relatedProduct->price - ( $relatedProduct->price * $relatedProduct->discount ) / 100  }}
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ارسال پاسخ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="" style="padding: 20px;background-color: #fff;">
                    <form action="{{ route('add.comment') }}" method="post" role="form">
                        @csrf
                        @method('post')
                        <input type="hidden" name="commentable_id" id="model-commentable_id">
                        <input type="hidden" name="commentable_type" id="model-commentable_type">
                        <input type="hidden" name="parent_id" id="model-parent_id">
                        <div class="form-group">
                            <textarea class="form-control" disabled id="review-body"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">reply:</label>
                            <textarea name="body" class="form-control" id="message-text"></textarea>
                            @error('body')
                            <label for="title" class="error">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">cancel</button>
                            <button type="submit" class="btn btn-primary">reply</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Product Details Section End -->

    @push('styles')
        <link rel="stylesheet" href="/default/css/css-stars.css">
    @endpush

    @push('scripts')
        {{--<script src="/js/app.js"></script>--}}
        <script>
            $('#exampleModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var recipient = button.data('whatever') ;// Extract info from data-* attributes
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var commentable_id = button.data('commentable_id') ;
                var commentable_type = button.data('commentable_type') ;
                var parent_id = button.data('parent_id') ;
                var body = button.data('body') ;
                var modal = $(this);
                modal.find('.modal-title').text(' answering to ' + recipient);
                modal.find('#review-body').val(body);
                modal.find('#model-commentable_id').val(commentable_id);
                modal.find('#model-commentable_type').val(commentable_type);
                modal.find('#model-parent_id').val(parent_id);
            })
        </script>

        @if(session()->has('message'))
            <script>
                iziToast.show({
                    title: " {{ auth()->user()->name }} ",
                    message: "{{ session('message') }}",
                    rtl: false,
                    color: 'green',
                });

            </script>
        @endif

        <script src="/default/js/jquery.barrating.min.js"></script>

        <script type="text/javascript">
            $(function() {
                $('#add-rating-css').barrating({
                    theme: 'css-stars',
                    allowEmpty: true,
                    emptyValue: 0,
                    deselectable: true
                });

            });
        </script>
    @endpush
@endsection

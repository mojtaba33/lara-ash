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
                        <div class="col-lg-12">
                            <div class="product__details__tab">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Add Review</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Reviews ( {{ $comments->count() }} )</a>
                                    </li>

                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane" id="tabs-2" role="tabpanel">
                                        <h6>Add Review</h6>
                                        <div class="row justify-content-md-center">

                                            <div class="col-6">

                                                @if(auth()->check())
                                                    <form method="post" action="{{ route('add.comment') }}" >
                                                        @csrf
                                                        <input type="hidden" name="commentable_id" id="blog_id" value="{{ $blog->id }}">
                                                        <input type="hidden" name="commentable_type" id="blog_id" value="{{ get_class($blog) }}">
                                                        <input type="hidden" name="parent_id" id="parent_id" value="0">
                                                        <input type="hidden" name="rate" id="rate" value="0">

                                                        <div class="form-group">
                                                            <label for="body">Review</label>
                                                            <textarea class="form-control" name="body" id="body" rows="4"></textarea>
                                                            @error('body')
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

    @endpush
@endsection
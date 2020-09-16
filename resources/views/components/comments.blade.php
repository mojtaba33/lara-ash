<ul class="comments">
    @foreach($comments as $comment)
    <li class="clearfix">
        <img src="{{ url($comment->user->image) }}" style="border-radius: 50%;" class="avatar" alt="">
        <div class="post-comments">
            <p class="meta">{{ $comment->created_at }} <a href="#"> <strong> {{ $comment->user->name }} </strong> </a> says :
                <i class="pull-right">
                    @if(auth()->check())
                    <a type="button"
                       class="text text-primary"
                       data-toggle="modal"
                       data-body="{{ json_encode($comment->body) }}"
                       data-product_id="{{ json_encode($comment->product_id) }}"
                       data-parent_id="{{ json_encode($comment->id) }}"
                       data-target="#exampleModal"
                       data-whatever="{{ json_encode($comment->user->name) }}"
                    >
                        <small>Reply</small>
                    </a>
                    @endif
                </i>
            </p>
            <p>
                {{ $comment->body }}
            </p>
            @if($comment->rate != 0)
            <div class="product__details__text ">
                <div class="rating">
                    @for($i=1; $i<=$comment->rate; $i++)
                    <i class="fa fa-star"></i>
                    @endfor
                    @for($i=5; $i > $comment->rate; $i--)
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                    @endfor
                </div>
            </div>
            @endif
        </div>

        <x-comments :comments="$comment->child()->where('approved' , 1)->get()"></x-comments>

    </li>
    @endforeach
</ul>
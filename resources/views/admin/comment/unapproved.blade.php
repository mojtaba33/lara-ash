@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
        <x-admin-alert :message="'message'" status="عملیات موفق" type="success" ></x-admin-alert>
        @if($comments->isNotEmpty())
                <section class="panel">
                    <header class="panel-heading">
                        {{ __('لیست کامنت های تایید نشده') }}
                    </header>
                    <table class="table table-striped table-advance table-hover">
                        <thead>
                        <tr>
                            <th>نام</th>
                            <th>ایمیل</th>
                            <th>درباره ی محصول</th>
                            <th>متن نظر</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($comments as $comment)

                            <tr>
                                <td>{{ $comment->user->name }}</td>
                                <td>{{ $comment->user->email }}</td>
                                <td><a href="{{ $comment->product->path() }}">{{ $comment->product->title }}</a></td>
                                <td>{{ $comment->body }}</td>
                                <td>
                                    <form action="{{route('comment.destroy',$comment->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <a href="{{ route('comment.confirm',$comment->id) }}" class="btn btn-success btn-xs"><i class="icon-thumbs-up"></i></a>
                                        <a href="{{ route('comment.reply',$comment->id) }}" class="btn btn-primary btn-xs"><i class="icon-reply"></i></a>
                                        <button class="btn btn-danger btn-xs"><i class="icon-trash "></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </section>
                <div class="text-center">
                    {{ $comments->links() }}
                </div>
            @else
                <p class="alert alert-warning">موردی جهت نمایش وجود ندارد.</p>
            @endif

        </div>
    </div>
@endsection

@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">

            <x-admin-alert message="message" status="عملیات موفق" type="success" ></x-admin-alert>

            @if($blogs->isNotEmpty())
                <section class="panel">
                    <header class="panel-heading">
                        {{ __(' لیست بلاگ ها  ') }}
                    </header>
                    <table class="table table-striped table-advance table-hover">
                        <thead>
                        <tr>
                            <th>عنوان</th>
                            <th>دسته بندی</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($blogs as $blog)

                            <tr>
                                <td><a href="{{ $blog->path() }}">{{ $blog->title }}</a></td>
                                <td><a href="{{ $blog->category->path() }}"> {{ $blog->category->title }} </a></td>
                                <td>

                                    <form action="{{route('blog.destroy',$blog->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <a href="{{ route('blog.edit',$blog->id) }}" class="btn btn-primary btn-xs"><i class="icon-pencil"></i></a>
                                        <button type="submit" class="btn btn-danger btn-xs"><i class="icon-trash "></i></button>
                                    </form>
                                </td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                </section>
                <div class="text-center">
                    {{ $blogs->links() }}
                </div>
            @else
                <p class="alert alert-warning">موردی جهت نمایش وجود ندارد.</p>
            @endif
        </div>
    </div>
@endsection

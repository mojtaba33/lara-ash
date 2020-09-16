@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">

            <x-admin-alert message="message" status="عملیات موفق" type="success" ></x-admin-alert>

            @if($categories->isNotEmpty())
                <section class="panel">
                    <header class="panel-heading">
                        {{ __('لیست دسته بندی ها') }}
                    </header>
                    <table class="table table-striped table-advance table-hover">
                        <thead>
                        <tr>
                            <th>عنوان</th>
                            <th>سرگروه</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)

                            <tr>
                                <td><a href="{{ $category->path() }}">{{ $category->title }}</a></td>
                                <td>{{ $category->parent_id == 0 ? 'سرگروه' : $category->parent->title }}</td>
                                <td>

                                    <form action="{{route('category.destroy',$category->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <a href="{{ route('category.edit',$category->id) }}" class="btn btn-primary btn-xs"><i class="icon-pencil"></i></a>
                                        <button type="submit" class="btn btn-danger btn-xs"><i class="icon-trash "></i></button>
                                        @if($category->parent_id != 0)
                                            <a href="{{ route('category.filter',$category->id) }}" class="btn btn-success btn-xs">افزودن فیلتر</a>
                                        @endif
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </section>
                <div class="text-center">
                    {{ $categories->links() }}
                </div>
            @else
                <p class="alert alert-warning">موردی جهت نمایش وجود ندارد.</p>
            @endif
        </div>
    </div>
@endsection

@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">

            <x-admin-alert message="message" status="عملیات موفق" type="success" ></x-admin-alert>

            @if($banners->isNotEmpty())
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
                        @foreach($banners as $banner)

                            <tr>
                                <td><a href="{{ $banner->url }}">{{ $banner->title }}</a></td>
                                <td>

                                    <form action="{{route('banner.destroy',$banner->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <a href="{{ route('banner.edit',$banner->id) }}" class="btn btn-primary btn-xs"><i class="icon-pencil"></i></a>
                                        <button type="submit" class="btn btn-danger btn-xs"><i class="icon-trash "></i></button>
                                        @if($banner->parent_id != 0)
                                            <a href="{{ route('banner.filter',$banner->id) }}" class="btn btn-success btn-xs">افزودن فیلتر</a>
                                        @endif
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </section>
                <div class="text-center">
                    {{ $banners->links() }}
                </div>
            @else
                <p class="alert alert-warning">موردی جهت نمایش وجود ندارد.</p>
            @endif
        </div>
    </div>
@endsection

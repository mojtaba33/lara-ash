@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">

            <x-admin-alert message="message" status="عملیات موفق" type="success" ></x-admin-alert>

            @if($services->isNotEmpty())
                <section class="panel">
                    <header class="panel-heading">
                        {{ __('لیست دسته بندی ها') }}
                    </header>
                    <table class="table table-striped table-advance table-hover">
                        <thead>
                        <tr>
                            <th>عنوان</th>
                            <th>توضیح</th>
                            <th>عکس</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($services as $service)

                            <tr>
                                <td>{{ $service->title }}</td>
                                <td>{{ $service->label }}</td>
                                <td><img src="{{ url($service->image) }}" height="65" alt=""></td>
                                <td>

                                    <form action="{{route('service.destroy',$service->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <a href="{{ route('service.edit',$service->id) }}" class="btn btn-primary btn-xs"><i class="icon-pencil"></i></a>
                                        <button type="submit" class="btn btn-danger btn-xs"><i class="icon-trash "></i></button>
                                        @if($service->parent_id != 0)
                                            <a href="{{ route('service.filter',$service->id) }}" class="btn btn-success btn-xs">افزودن فیلتر</a>
                                        @endif
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </section>
                <div class="text-center">
                    {{ $services->links() }}
                </div>
            @else
                <p class="alert alert-warning">موردی جهت نمایش وجود ندارد.</p>
            @endif
        </div>
    </div>
@endsection

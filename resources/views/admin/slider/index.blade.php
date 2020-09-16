@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">

            <x-admin-alert message="message" status="عملیات موفق" type="success" ></x-admin-alert>

            @if($sliders->isNotEmpty())
                <section class="panel">
                    <header class="panel-heading">
                        {{ __('لیست اسلاید ها') }}
                    </header>
                    <table class="table table-striped table-advance table-hover">
                        <thead>
                        <tr>
                            <th>عنوان</th>
                            <th>لیبل</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sliders as $slider)

                            <tr>
                                <td><a href="{{ $slider->url }}">{{ $slider->title }}</a></td>
                                <td>{{ $slider->label }}</td>
                                <td>

                                    <form action="{{route('slider.destroy',$slider->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <a href="{{ route('slider.edit',$slider->id) }}" class="btn btn-primary btn-xs"><i class="icon-pencil"></i></a>
                                        <button type="submit" class="btn btn-danger btn-xs"><i class="icon-trash "></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </section>
                <div class="text-center">
                    {{ $sliders->links() }}
                </div>
            @else
                <p class="alert alert-warning">موردی جهت نمایش وجود ندارد.</p>
            @endif
        </div>
    </div>
@endsection

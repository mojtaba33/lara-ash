@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">

            <x-admin-alert message="message" status="عملیات موفق" type="success" ></x-admin-alert>

            @if($coupons->isNotEmpty())
                <section class="panel">
                    <header class="panel-heading">
                        {{ __('لیست کدهای تخفیف') }}
                    </header>
                    <table class="table table-striped table-advance table-hover">
                        <thead>
                        <tr>
                            <th>کد تخفیف</th>
                            <th>مقدار تخفیف(درصد)</th>
                            <th>زمان انقضا</th>
                            <th>دسته بندی</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($coupons as $coupon)

                            <tr>
                                <td>{{ $coupon->code }}</td>
                                <td>{{ $coupon->value }}</td>
                                <td>{{ $coupon->expired_at }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cats">
                                        دسته بندی ها
                                    </button>
                                </td>
                                <td>
                                    <form action="{{route('admin.coupon.destroy',$coupon->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <a href="{{ route('admin.coupon.edit',$coupon->id) }}" class="btn btn-primary btn-xs"><i class="icon-pencil"></i></a>
                                        <button type="submit" class="btn btn-danger btn-xs"><i class="icon-trash "></i></button>
                                    </form>
                                </td>
                                {{--<script>
                                    $('#myModal').on('shown.bs.modal', function () {
                                        $('#myInput').trigger('focus')
                                    })
                                </script>--}}
                            </tr>
                            <div class="modal fade" id="cats" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <ul class="modal-content list-group">
                                        <li class="list-group-item active">دسته بندی ها</li>
                                        @foreach($coupon->categories as $cat)
                                            <li class="list-group-item">
                                                <a href="{{ $cat->path() }}">{{ $cat->title }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                        </tbody>
                    </table>
                </section>
                <div class="text-center">
                    {{ $coupons->links() }}
                </div>
            @else
                <p class="alert alert-warning">موردی جهت نمایش وجود ندارد.</p>
            @endif
        </div>
    </div>
@endsection

@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <x-admin-alert :message="'message'" status="عملیات موفق" type="success" ></x-admin-alert>
        @if($orders->isNotEmpty())
                <section class="panel">
                    <header class="panel-heading">
                        {{ __('لیست سفارشات ') }}
                    </header>
                    <table class="table table-striped table-advance table-hover">
                        <thead>
                        <tr>
                            <th>نام</th>
                            <th>نام خانوادگی</th>
                            <th>آدرس</th>
                            <th>تلفن</th>
                            <th>کد پستی</th>
                            <th>ایمیل</th>
                            <th>سفارشات</th>
                            <th>وضغیت سفارش</th>
                            <th>تعداد سفارشات</th>
                            <th>مبلغ پرداختی</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)

                            <tr>
                                <td>{{ $order->name }}</td>
                                <td>{{ $order->lastName }}</td>
                                <td>{{ $order->address }}</td>
                                <td>{{ $order->phone }}</td>
                                <td>{{ $order->postCode }}</td>
                                <td>{{ $order->user->email }}</td>
                                <td><a class="btn btn-sm btn-info" href="{{ route('order.single',$order->id) }}">{{ __('مشاهده ی سفارشات') }}</a></td>
                                <td>
                                    @if($order->deliver==0)
                                        <form action="{{ route('order.deliver',$order->id) }}" method="post" >
                                            @csrf
                                            @method('patch')
                                            <button type="submit" class="btn btn-sm btn-danger">{{ __('تحویل داده نشده') }}</button>
                                        </form>
                                    @else
                                        <span class="btn btn-sm btn-success">{{ __('تحویل داده شده') }}</span>
                                    @endif
                                </td>
                                <td>{{ $order->count }}</td>
                                <td>{{ number_format($order->price) }} تومان  </td>

                                {{--<td>
                                    <form action="{{route('order.destroy',$order->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <a href="{{ route('order.edit',$order->id) }}" class="btn btn-primary btn-xs"><i class="icon-pencil"></i></a>
                                        <button class="btn btn-danger btn-xs"><i class="icon-trash "></i></button>
                                    </form>
                                </td>--}}
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </section>
                <div class="text-center">
                    {{ $orders->links() }}
                </div>
            @else
                <p class="alert alert-warning">موردی جهت نمایش وجود ندارد.</p>
            @endif

        </div>
    </div>
@endsection

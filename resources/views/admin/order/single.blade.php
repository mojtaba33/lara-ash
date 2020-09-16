@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">

            <x-admin-alert :message="'message'" status="عملیات موفق" type="success" ></x-admin-alert>

            <section class="panel">
                    <header class="panel-heading">
                        {{ __('لیست سفارشات ') }}
                    </header>
                    <table class="table table-striped table-advance table-hover">
                        <thead>
                        <tr>
                            <th colspan="2"></th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>نام</td>
                                <td >{{ $checkout->name }}</td>
                            </tr>
                            <tr>
                                <td>نام خانوادگی</td>
                                <td>{{ $checkout->lastName }}</td>
                            </tr>
                            <tr>
                                <td>آدرس</td>
                                <td>{{ $checkout->address }}</td>
                            </tr>
                            <tr>
                                <td>تلفن</td>
                                <td>{{ $checkout->phone }}</td>
                            </tr>
                            <tr>
                                <td>کد پستی</td>
                                <td>{{ $checkout->postCode }}</td>
                            </tr>
                            <tr>
                                <td>ایمیل</td>
                                <td>{{ $checkout->user->email }}</td>
                            </tr>
                            <tr>
                                <td>وضعیت سفارش</td>
                                <td>
                                    @if($checkout->deliver==0)
                                        <form action="{{ route('order.deliver',$checkout->id) }}" method="post" >
                                            @csrf
                                            @method('patch')
                                            <button type="submit" class="btn btn-sm btn-danger">{{ __('تحویل داده نشده') }}</button>
                                        </form>
                                    @else
                                        <span class="btn btn-sm btn-success">{{ __('تحویل داده شده') }}</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>تعداد سفارشات</td>
                                <td>{{ $checkout->count }}</td>
                            </tr>
                            <tr>
                                <td>مبلغ پرداختی</td>
                                <td>{{ number_format($checkout->price) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </section>

                <section class="panel">
                    <header class="panel-heading no-border">
                        محصولات سفارش داده شده
                    </header>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>نام محصول</th>
                            <th>رنگ</th>
                            <th>اندازه</th>
                            <th>تعداد</th>
                            <th>پرداختی</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($carts as $key=>$item)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td><a href="{{ \App\Product::find($item->product_id)->path() }}">{{ \App\Product::find($item->product_id)->title }}</a></td>
                            <td>{{ $item->color==null ? '-' : $item->color }}</td>
                            <td>{{ $item->size==null ? '-' : $item->size }}</td>
                            <td>{{ $item->count }}</td>
                            <td>{{ number_format($item->product->getPrice() * $item->count) }}  تومان  </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </section>

        </div>
    </div>
@endsection

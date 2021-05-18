@extends('admin.layouts.master')
@section('content')
    <h1 class="text text-center text-warning"></h1>
    <div class="row">
        <div class="col-md-3 state-overview">
            <section class="panel">
                <div class="symbol " style="background-color: #8175c7">
                    <h4 style="color: #fff;">بازدید ها</h4>
                </div>
                <div class="value">
                    <h1>{{ $visits }}</h1>
                </div>
            </section>
        </div>
        <div class="col-md-3 state-overview">
            <section class="panel">
                <div class="symbol" style="background-color: #58C9F3;">
                    <h4 style="color: #fff;">بازدید کننده ها</h4>
                </div>
                <div class="value">
                    <h1>{{ $visitors }}</h1>
                    <p>نفر</p>
                </div>
            </section>
        </div>
        <div class="col-md-3 state-overview">
            <section class="panel">
                <div class="symbol" style="background-color: #aec785;">
                    <h5 style="color: #fff;">پرداخت های موفق</h5>
                </div>
                <div class="value">
                    <h1>{{ $succussfulPayment }}</h1>
                </div>
            </section>
        </div>
        <div class="col-md-3 state-overview">
            <section class="panel">
                <div class="symbol red">
                    <h5 style="color: #fff;">پرداخت های ناموفق</h5>
                </div>
                <div class="value">
                    <h1>{{ $unsuccussfulPayment }}</h1>
                </div>
            </section>
        </div>
    </div>

    <visit-chart style="margin-top: 40px;" :labels="{{ json_encode($labels) }}" :values="{{  json_encode($chartValues) }}" ></visit-chart>
@endsection

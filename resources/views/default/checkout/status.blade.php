@extends('default.layouts.master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card mx-auto my-5" style="width: 18rem;">
                <div class="card-header">
                    <h4>payment status</h4>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">status : {{ request('Status') == 'OK' ? 'Successful payment' : 'Payment failed' }}</li>
                    @if(request('Status') == 'OK')
                        <li class="list-group-item">price : {{ $price }}</li>
                    @endif
                    <li class="list-group-item">reference id : {{ $ref_id }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('default.layouts.master')
@section('content')
<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="./index.html"><i class="fa fa-home"></i> Home</a>
                    <span>Shopping cart</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h6 class="coupon__link"><span class="icon_tag_alt"></span> <a href="#">Have a coupon?</a> Click
                    here to enter your code.</h6>
            </div>
        </div>
        <div class="checkout__form">
            <div class="row">
                <div class="col-lg-8">
                    <h5>Billing detail</h5>
                    @if(session()->has('message'))
                        <div class="myAlert col-lg-12">
                            {{ session('message') }}
                        </div>
                    @endif
                    <div class="row">
                        <form action="{{ route('cart.address',$checkout) }}" method="post" class="col-lg-12">
                            @csrf
                            @method('patch')
                        <div class="col-lg-12">
                            <div class="checkout__form__input">
                                <p>First Name <span>*</span></p>
                                <input type="text" name="name" value="{{ $checkout->name != null ? $checkout->name : ''  }}">
                                @error('name')
                                <label for="title" class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="checkout__form__input">
                                <p>Last Name <span>*</span></p>
                                <input type="text" name="lastName" value="{{ $checkout->lastName != null ? $checkout->lastName : ''  }}">
                                @error('lastName')
                                <label for="title" class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="checkout__form__input">
                                <p>Address <span>*</span></p>
                                <input type="text" name="address" value="{{ $checkout->address != null ? $checkout->address : ''  }}">
                                @error('address')
                                <label for="title" class="error">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="checkout__form__input">
                                <p>Postcode/Zip <span>*</span></p>
                                <input type="text" name="postCode" value="{{ $checkout->postCode != null ? $checkout->postCode : ''  }}">
                                @error('postCode')
                                <label for="title" class="error">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="checkout__form__input">
                                <p>Phone <span>*</span></p>
                                <input type="text" name="phone" value="{{ $checkout->phone != null ? $checkout->phone : ''  }}">
                                @error('phone')
                                <label for="title" class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <input type="submit" value="submit" class="site-btn">
                        </div>
                        {{--<div class="col-lg-12">
                            <div class="checkout__form__checkbox">
                                <label for="acc">
                                    Create an acount?
                                    <input type="checkbox" id="acc">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Create am acount by entering the information below. If you are a returing
                                    customer login at the <br />top of the page</p>
                            </div>
                            <div class="checkout__form__input">
                                <p>Account Password <span>*</span></p>
                                <input type="text">
                            </div>
                            <div class="checkout__form__checkbox">
                                <label for="note">
                                    Note about your order, e.g, special noe for delivery
                                    <input type="checkbox" id="note">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="checkout__form__input">
                                <p>Oder notes <span>*</span></p>
                                <input type="text"
                                       placeholder="Note about your order, e.g, special noe for delivery">
                            </div>
                        </div>--}}
                        </form>
                    </div>

                </div>
                <div class="col-lg-4">
                    <div class="checkout__order">
                        <h5>Your order</h5>
                        <div class="checkout__order__product">
                            <ul>
                                <li>
                                    <span class="top__text">Product</span>
                                    <span class="top__text__right">Total</span>
                                </li>
                                @foreach($carts as $cart)
                                <li>{{ $cart->product->title }} x {{ $cart->count }} <span>$ {{ $cart->product->getPrice() * $cart->count}}</span></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="checkout__order__total">
                            <ul>
                                <li>Subtotal <span>$ {{ $totalPrice }}</span></li>
                                <li>Total <span>$ {{ $totalPrice }}</span></li>
                            </ul>
                        </div>
                        {{--<div class="checkout__order__widget">
                            <label for="o-acc">
                                Create an acount?
                                <input type="checkbox" id="o-acc">
                                <span class="checkmark"></span>
                            </label>
                            <p>Create am acount by entering the information below. If you are a returing customer
                                login at the top of the page.</p>
                            <label for="check-payment">
                                Cheque payment
                                <input type="checkbox" id="check-payment">
                                <span class="checkmark"></span>
                            </label>
                            <label for="paypal">
                                PayPal
                                <input type="checkbox" id="paypal">
                                <span class="checkmark"></span>
                            </label>
                        </div>--}}
                        <form action="{{ route('payment','Zarinpal') }}" method="post">
                            @csrf
                            <button type="submit" class="site-btn">Place oder</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Checkout Section End -->
@push('styles')
    <style>
        .error{
            color: red;
            margin-top: -20px;
            display: block;
            font-size: 13px;
        }
        .myAlert{
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
            position: relative;
            padding: .75rem 1.25rem;
            margin-bottom: 1rem;
            border-radius: .25rem;
        }
    </style>
@endpush
@endsection

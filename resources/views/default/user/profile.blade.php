@extends('default.layouts.master')
@section('content')
    <section class="categories mt-5 mb-5">
        <div class="container-fluid">
            <div class="row justify-content-md-center">
                <div class="col-lg-12">
                    <ul class="nav nav-tabs 6" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="panel-tab" data-toggle="tab" href="#panel" role="tab" aria-controls="panel" aria-selected="true">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="update-profile-tab" data-toggle="tab" href="#update-profile" role="tab" aria-controls="update-profile" aria-selected="false">Update Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="change-password-tab" data-toggle="tab" href="#change-password" role="tab" aria-controls="change-password" aria-selected="false">Change Password</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="payment-tab" data-toggle="tab" href="#payment" role="tab" aria-controls="payment" aria-selected="false">Payment</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="favorite-tab" data-toggle="tab" href="#favorite" role="tab" aria-controls="favorite" aria-selected="false">favorite product</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="panel" role="tabpanel" aria-labelledby="panel-tab">
                            <div class="row justify-content-md-center">
                                <div class="col-lg-6">
                                    <div class="col-lg-3 mb-4">
                                        <img src="{{ url($user->image) }}"  style="border-radius: 50%;width:70px;height:70px" alt="" >
                                    </div>
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <b>name : </b> {{ $user->name }}
                                        </li>
                                        <li class="list-group-item">
                                            <b>email : </b> {{ $user->email }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="update-profile" role="tabpanel" aria-labelledby="update-profile-tab">
                            <div class="row justify-content-md-center">
                                <div class="col-lg-6">
                                    <form action="{{ route('user.profile.update') }}" enctype="multipart/form-data" method="post">
                                        @csrf
                                        @method('patch')
                                        <div class="form-group">
                                            <label for="email">Email address</label>
                                            <input type="email" name="email" value="{{ $user->email }}" class="form-control" id="email" aria-describedby="emailHelp" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">name</label>
                                            <input type="text" name="name" value="{{ $user->name }}" class="form-control" id="name">
                                        </div>
                                        <div class="form-group">
                                            <label for="image">image</label>
                                            <input type="file" name="image" class="form-control-file" id="image">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="change-password" role="tabpanel" aria-labelledby="change-password-tab">
                            <div class="row justify-content-md-center">
                                <div class="col-lg-6">
                                    <form method="POST" action="{{ route('password.email') }}">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                            <div class="col-md-6">
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row mb-0">
                                            <div class="col-md-6 offset-md-4">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Send Password Reset Link') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="payment" role="tabpanel" aria-labelledby="payment-tab">
                            <table class="table table-striped table-advance table-hover">
                                <thead>
                                <tr>
                                    <th>name</th>
                                    <th>last name</th>
                                    <th>phone</th>
                                    <th>email</th>
                                    <th>address</th>
                                    <th>post code</th>
                                    <th>status</th>
                                    <th>count</th>
                                    <th>price</th>
                                    <th>orders</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($payment as $pay)

                                    <tr>
                                        <td>{{ $pay->name }}</td>
                                        <td>{{ $pay->lastName }}</td>
                                        <td>{{ $pay->phone }}</td>
                                        <td>{{ auth()->user()->email }}</td>
                                        <td>{{ $pay->address }}</td>
                                        <td>{{ $pay->postCode }}</td>
                                        <td>
                                            @if($pay->deliver==0)
                                                <button class="btn btn-sm btn-primary">{{ __('on the way') }}</button>
                                            @else
                                                <button class="btn btn-sm btn-success">{{ __('delivered') }}</button>
                                            @endif
                                        </td>
                                        <td>{{ $pay->count }}</td>
                                        <td>{{ number_format($pay->price) }} تومان  </td>
                                        <td>
                                            <!-- Large modal -->
                                            <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target=".bd-example-modal-lg">{{ __('show') }}</button>

                                            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th> name</th>
                                                                <th>color</th>
                                                                <th>size</th>
                                                                <th>count</th>
                                                                <th>price</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($pay->carts()->get() as $key=>$item)
                                                                <tr>
                                                                    <td>{{ $key+1 }}</td>
                                                                    <td><a style="color: #000;" href="{{ \App\Product::find($item->product_id)->path() }}">{{ \App\Product::find($item->product_id)->title }}</a></td>
                                                                    <td>{{ $item->color==null ? '-' : $item->color }}</td>
                                                                    <td>{{ $item->size==null ? '-' : preg_replace('/\'/ ', '', $item->size) }}</td>
                                                                    <td>{{ $item->count }}</td>
                                                                    <td>{{ number_format($item->product->getPrice() * $item->count) }}  تومان  </td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane fade" id="favorite" role="tabpanel" aria-labelledby="favorite-tab">
                            <table class="table table-striped table-advance">
                                    <thead>
                                    <tr>
                                        <th>title</th>
                                        <th>image</th>
                                        <th>price</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach(auth()->user()->favorites as $product)
                                        <tr>
                                            <td class="align-middle"><a style="color: #000;" href="{{ $product->path() }}">{{ $product->title }}</a></td>
                                            <td class="align-middle"><img src="{{ url($product->image[90]) }}" alt=""></td>
                                            <td class="align-middle">{{ $product->getPrice() }}</td>
                                            <td class="align-middle">
                                                <form action="{{ route('delete.fav',$product) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        remove
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Extra large modal -->
@endsection
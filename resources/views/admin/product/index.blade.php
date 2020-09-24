@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">

            <x-admin-alert message="message" status="عملیات موفق" type="success" ></x-admin-alert>

            @if($products->isNotEmpty())
                <section class="panel" >
                    <header class="panel-heading" style="display: flex;justify-content: space-between">
                        {{ __(' لیست محصولات  ') }}
                        <form action="" >
                            <input type="text" name="item" class="form-control search" placeholder="Search">
                        </form>
                    </header>
                    <table class="table table-striped table-advance table-hover">
                        <thead>
                        <tr>
                            <th>عنوان</th>
                            <th>دسته بندی</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)

                            <tr>
                                <td><a href="{{ $product->path() }}">{{ $product->title }}</a></td>
                                <td><a href="{{ $product->category->path() }}"> {{ $product->category->title }} </a></td>
                                @can('edit-own-product',$product)
                                <td>

                                    <form action="{{route('product.destroy',$product->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <a href="{{ route('product.edit',$product->id) }}" class="btn btn-primary btn-xs"><i class="icon-pencil"></i></a>

                                        <a href="{{ route('product.gallery',$product->slug) }}" class="btn btn-info btn-xs"><i class="icon-picture"></i></a>
                                        <a href="{{ route('product.option',$product->id) }}" class="btn btn-info btn-xs">افزودن مشخصات</a>

                                        <button type="submit" class="btn btn-danger btn-xs"><i class="icon-trash "></i></button>
                                    </form>
                                </td>
                                @endcan
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                </section>
                <div class="text-center">
                    {{ $products->links() }}
                </div>
            @else
                <p class="alert alert-warning">موردی جهت نمایش وجود ندارد.</p>
            @endif
        </div>
    </div>
@endsection

@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            @if(session()->has('message'))
                @component('admin.component.alert')
                    @slot('class')
                        success
                    @endslot
                    @slot('status')

                    @endslot
                    {{ session('message') }}
                @endcomponent
            @endif
            @if($roles->isNotEmpty())
            <section class="panel">
                <header class="panel-heading">
                    {{ __('لیست مقام ها') }}
                </header>
                <table class="table table-striped table-advance table-hover">
                    <thead>
                    <tr>
                        <th>عنوان</th>
                        <th>عنوان فارسی</th>
                        <th>سطوح دسترسی</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $role)

                        <tr>
                            <td>{{ $role->title }}</td>
                            <td>{{ $role->fa_title }}</td>
                            <td>@foreach($role->permissions()->get() as $permission)
                                    < {{ $permission->fa_title }} >
                                @endforeach
                            </td>
                            <td>

                                <form action="{{route('role.destroy',$role->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <a href="{{ route('role.edit',$role->id) }}" class="btn btn-primary btn-xs"><i class="icon-pencil"></i></a>
                                    <button class="btn btn-danger btn-xs"><i class="icon-trash "></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </section>
            <div class="text-center">
                {{ $roles->links() }}
            </div>
            @else
                <p class="alert alert-warning">موردی جهت نمایش وجود ندارد.</p>
            @endif
        </div>
    </div>
@endsection

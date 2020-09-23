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
            @if($users->isNotEmpty())
            <section class="panel">
                <header class="panel-heading">
                    {{ __('لیست دسته بندی ها') }}
                </header>
                <table class="table table-striped table-advance table-hover">
                    <thead>
                    <tr>
                        <th>نام</th>
                        <th>ایمیل</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)

                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->level == 'admin' ? 'ادمین' : 'کاربر عادی' }}</td>
                            <td>

                                <form action="{{route('user.destroy',$user->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <a href="{{ route('user.edit',$user->id) }}" class="btn btn-primary btn-xs"><i class="icon-pencil"></i></a>
                                    <button class="btn btn-danger btn-xs"><i class="icon-trash "></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </section>
            <div class="text-center">
                {{ $users->links() }}
            </div>
            @else
                <p class="alert alert-warning">موردی جهت نمایش وجود ندارد.</p>
            @endif
        </div>
    </div>
@endsection

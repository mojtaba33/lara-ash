<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ashion Template">
    <meta name="keywords" content="Ashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ashion | Template</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap"
          rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="/css/app.css" type="text/css">
    @stack('styles')
</head>

<body>
<div id="app">
<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>

<!-- Offcanvas Menu Begin -->
<div class="offcanvas-menu-overlay"></div>
<div class="offcanvas-menu-wrapper">
    <div class="offcanvas__close">+</div>
    <ul class="offcanvas__widget">
        <li><span class="icon_search search-switch"></span></li>
        <li><a href="{{ route('user.profile') }}"><span class="icon_heart_alt"></span>
                <div class="tip">{{ auth()->check() ? auth()->user()->favorites->count() : '0' }}</div>
            </a></li>
        <li><a href="#"><span class="icon_bag_alt"></span>
                <div class="tip">2</div>
            </a></li>
    </ul>
    <div class="offcanvas__logo">
        <a href="./index.html"><img src="/default/img/logo.png" alt=""></a>
    </div>
    <div id="mobile-menu-wrap"></div>
    <div class="offcanvas__auth">
        <a href="#">Login</a>
        <a href="#">Register</a>
    </div>
</div>
<!-- Offcanvas Menu End -->

<!-- Header Section Begin -->
<header class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3 col-lg-2">
                <div class="header__logo">
                    <a href="{{ url('/') }}"><img src="/default/img/logo.png" alt=""></a>
                </div>
            </div>
            <div class="col-xl-6 col-lg-7">
                <nav class="header__menu">
                    <ul>
                        <li class="active"><a href="{{ url('/') }}">Home</a></li>
                        @foreach($categories as $category)
                        <li>
                            <a href="{{ $category->path() }}">{{ $category->title }}</a>
                            @if($category->children()->get()->isNotEmpty())
                            <ul class="dropdown">
                                @foreach($category->children()->get() as $cat)
                                <li><a href="{{ $cat->path() }}">{{ $cat->title }}</a></li>
                                @endforeach
                            </ul>
                            @endif
                        </li>
                        @endforeach
                        <li><a href="./shop.html">Shop</a></li>
                        <li><a href="{{ route('blog.all') }}">Blog</a></li>
                        <li><a href="./contact.html">Contact</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="header__right" style="display: flex;justify-content: center;align-items: center;">
                    <div class="header__right__auth" style="display: flex;justify-content: center;align-items: center;">
                        @guest
                            <a href="{{ route('login') }}">Login</a>
                            <a href="{{ route('register') }}">Register</a>
                        @else
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <input type="submit" value="logout" style="border: none;outline: none;font-size: 12px;background-color: transparent;color: #666666;position: relative;margin-right: 8px;">
                            </form>
                            <a href="{{ route('user.profile') }}" class="btn btn-sm btn-light">profile</a>
                        @if(auth()->user()->level === 'admin')
                                <a href="{{ route('admin.panel') }}" style="font-size: 12px;" class="btn btn-sm btn-outline-primary">Admin</a>
                            @endif
                        @endguest

                    </div>
                    <ul class="header__right__widget" style="display: flex;justify-content: center;align-items: center;">
                        <li><span class="icon_search search-switch"></span></li>
                        <li><a href="{{ route('user.profile') }}"><span class="icon_heart_alt"></span>
                                <div class="tip">{{ auth()->check() ? auth()->user()->favorites->count() : '0' }}</div>
                            </a></li>
                        <cart :carts="carts"></cart>
                    </ul>
                </div>
            </div>
        </div>
        <div class="canvas__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
<!-- Header Section End -->
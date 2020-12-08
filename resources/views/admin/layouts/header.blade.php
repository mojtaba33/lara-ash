<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="/admin/img/favicon.html">

    <title>پنل ادمین</title>


    <!-- Bootstrap core CSS -->
    <link href="/admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="/admin/css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="/admin/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="/admin/css/style.css" rel="stylesheet">
    <link href="/admin/css/style-responsive.css" rel="stylesheet" />

    @stack('header-script')

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="/admin/js/html5shiv.js"></script>
    <script src="/admin/js/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<section id="container" class="">
    <!--header start-->
    <header class="header white-bg">
        <div class="sidebar-toggle-box">
            <div data-original-title="Toggle Navigation" data-placement="right" class="icon-reorder tooltips"></div>
        </div>
        <!--logo start-->
        <a href="/admin/#" class="logo">فلت<span>لب</span></a>
        <!--logo end-->
        <div class="top-nav ">
            <!--search & user info start-->
            <ul class="nav pull-right top-menu">
                <!-- user login dropdown start-->
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="/admin/#">
                        <img alt="" width="50" src="/{{ auth()->user()->image  }}">
                        <span class="username"> {{ auth()->user()->name  }}</span>
                        <b class="caret"></b>
                    </a>

                    <ul class="dropdown-menu extended logout" style="left:-80px !important;">
                        <div class="log-arrow-up"></div>
                        {{-- <li><a href="/admin/#"><i class=" icon-suitcase"></i>پروفایل</a></li>
                        <li><a href="/admin/#"><i class="icon-cog"></i>تنظیمات</a></li>
                        <li><a href="/admin/#"><i class="icon-bell-alt"></i>اعلام ها</a></li> --}}
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" value="logout" style="background: #a9d96c; padding: 15px 10px !important; width: 100%; display: inline-block; color: #fff; border-bottom: none !important; text-transform: uppercase;">
                                <i class="icon-key"></i>خروج</a>
                            </button>
                        </form>
                    </ul>
                </li>
                <!-- user login dropdown end -->
            </ul>
            <!--search & user info end-->
        </div>
    </header>
    <!--header end-->
    <!--sidebar start-->
    <x-admin-aside></x-admin-aside>
    <!--sidebar end-->
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper" id="app">
            <!-- page start-->

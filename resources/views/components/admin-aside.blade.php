<aside>
    <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu">
            <li class="active">
                <a class="" href="{{ url('/') }}">
                    <i class="icon-dashboard"></i>
                    <span>صفحه اصلی</span>
                </a>
            </li>
            @can('edit-users')
                <li class="sub-menu">
                    <a href="javascript:;" class="">
                        <i class="icon-book"></i>
                        <span>کاربران</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub">
                        <li><a class="" href="{{ route('user.index') }}"> لیست کاربران </a></li>
                        <li><a class="" href="{{ route('user.admins') }}"> لیست ادمین ها </a></li>
                        <li><a class="" href="{{ route('role.index') }}"> لیست مقام ها </a></li>
                        <li><a class="" href="{{ route('role.create') }}"> افزودن مقام جدید </a></li>
                    </ul>
                </li>
            @endcan
            <li class="sub-menu">
                <a href="javascript:;" class="">
                    <i class="icon-cogs"></i>
                    <span>دسته بندی ها</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub">
                    <li><a class="" href="{{ route('category.index') }}">لیست دسته بندی ها</a></li>
                    <li><a class="" href="{{ route('category.create') }}">افزودن دسته بندی</a></li>
                </ul>
            </li>

            <li class="sub-menu">
                <a href="javascript:;" class="">
                    <i class="icon-cogs"></i>
                    <span>بنر ها</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub">
                    <li><a class="" href="{{ route('banner.index') }}">لیست بنر ها</a></li>
                    <li><a class="" href="{{ route('banner.create') }}">افزودن بنر</a></li>
                </ul>
            </li>

            <li class="sub-menu">
                <a href="javascript:;" class="">
                    <i class="icon-cogs"></i>
                    <span> محصولات </span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub">
                    <li><a class="" href="{{ route('product.index') }}">لیست محصولات</a></li>
                    <li><a class="" href="{{ route('product.create') }}">افزودن محصول جدید</a></li>
                    <li><a class="" href="{{ route('product.topOffer') }}">لیست محصولات ویژه</a></li>
                </ul>
            </li>

            <li class="sub-menu">
                <a href="javascript:;" class="">
                    <i class="icon-cogs"></i>
                    <span> بلاگ ها </span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub">
                    <li><a class="" href="{{ route('blog.index') }}">لیست بلاگ</a></li>
                    <li><a class="" href="{{ route('blog.create') }}">افزودن بلاگ جدید</a></li>
                </ul>
            </li>

            <li class="sub-menu">
                <a href="javascript:;" class="">
                    <i class="icon-book"></i>
                    <span>کامنت ها</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub">
                    <li><a class="" href="{{ route('comment.unapproved') }}"> کامنت های تایید نشده </a></li>
                    <li><a class="" href="{{ route('comment.approved') }}"> کامنت های تایید شده </a></li>
                </ul>
            </li>

            <li class="sub-menu">
                <a href="javascript:;" class="">
                    <i class="icon-cogs"></i>
                    <span> اسلایدر </span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub">
                    <li><a class="" href="{{ route('slider.index') }}">لیست اسلاید ها</a></li>
                    <li><a class="" href="{{ route('slider.create') }}">افزودن اسلاید جدید</a></li>
                </ul>
            </li>

            <li class="sub-menu">
                <a href="javascript:;" class="">
                    <i class="icon-cogs"></i>
                    <span> خدمات </span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub">
                    <li><a class="" href="{{ route('service.index') }}">لیست خدمات ها</a></li>
                    <li><a class="" href="{{ route('service.create') }}">افزودن خدمات جدید</a></li>
                </ul>
            </li>

            <li class="sub-menu">
                <a href="javascript:;" class="">
                    <i class="icon-cogs"></i>
                    <span> سفارشات </span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub">
                    <li><a class="" href="{{ route('order.index') }}">لیست سفارشات</a></li>
                    <li><a class="" href="{{ route('order.delivered') }}"> تحویل داده شده</a></li>
                    <li><a class="" href="{{ route('order.undelivered') }}"> تحویل داده نشده</a></li>
                </ul>
            </li>

            <li>
                <a class="" href="{{ url('/login') }}">
                    <i class="icon-user"></i>
                    <span>صفحه ورود به سایت</span>
                </a>
            </li>
        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>
<header data-spy="affix" data-offset-top="1" class="clearfix">
    <section class="toolbar">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 left_bar">
                    <ul class="left-none">
                        @if(auth()->check())
                            <li><a href="{{ route('accounts', ['tab' => 'profile']) }}"><i class="fa fa-home"></i> My Account</a></li>
                            <li><a href="{{ route('logout') }}"><i class="fa fa-sign-out"></i>
                        @else
                            <li><a href="{{ route('login') }}"> <i class="fa fa-lock"></i> Login</a></li>
                            <li><a href="{{ route('register') }}"> <i class="fa fa-sign-in"></i> Register</a></li>
                        @endif
                        <li><i class="fa fa-search"></i>
                            <input type="search" placeholder="Search" class="search_box">
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6 ">
                    <ul class="right-none pull-right company_info">
                        <li><a href="tel:{{ config('shop.phone') }}"><i class="fa fa-phone"></i> {{ phone_format(config('shop.phone')) }}</a>
                        </li>
                        <li class="address"><a href="contact.html"><i class="fa fa-map-marker"></i>{{ config('shop.address') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="toolbar_shadow"></div>
    </section>
    <div class="bottom-header">
        <div class="container">
            <nav class="navbar navbar-default" role="navigation">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target="#bs-example-navbar-collapse-1"><span class="sr-only">Переключить навигацию</span>
                            <span class="icon-bar"></span> <span class="icon-bar"></span> <span
                                class="icon-bar"></span></button>
                        <a class="navbar-brand" href="/"><span class="logo">
                          <img src="{{ asset('images/logo-2.png') }}" class="main_logo" alt="logo">
                                <!--<img src="" class="pdf_print_logo">-->
                          </span>
                        </a>
                    </div>

                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav pull-right">
                            <li class="{{ (request()->is('/')) ? 'active' : '' }}"><a href="/">Главная</a></li>
                            <li class="{{ (request()->is('mashinokomplekty')) ? 'active' : '' }}"><a href="/mashinokomplekty">Машинокомплекты</a></li>
                            <li class="{{ (request()->is('transportirovka')) ? 'active' : '' }}"><a href="/transportirovka">Транспортировка</a></li>
                            <li class="{{ (request()->is('kak-kupit')) ? 'active' : '' }}"><a href="/kak-kupit">Как купить</a></li>
                            <li class="{{ (request()->is('otzyivyi')) ? 'active' : '' }}"><a href="/otzyivyi">Отзывы</a></li>
                            <li class="dropdown">
                                <a href="/kontakty" class="dropdown-toggle">Контакты
                                    <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li ><a href="/sotrudnichestvo">Сотрудничество</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
                <!-- /.container-fluid -->
            </nav>
        </div>
        <div class="header_shadow"></div>
    </div>
</header>
<div class="clearfix"></div>
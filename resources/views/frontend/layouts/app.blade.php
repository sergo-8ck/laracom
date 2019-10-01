<!doctype html>
<!--[if IE 7 ]>
<html lang="ru" class="ie7"> <![endif]-->
<!--[if IE 8 ]>
<html lang="ru" class="ie8"> <![endif]-->
<!--[if IE 9 ]>
<html lang="ru" class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="ru">
<!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('seo_keywords')">
    <meta name="author" content="{{ config('app.name') }}">
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">

    <!-- HTML5 shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script type="text/javascript" src="{{ asset('js/html5shivrespond.js') }}"></script>
    <![endif]-->

    <link rel="stylesheet" type="text/css"
          href="http://fonts.googleapis.com/css?family=Yellowtail%7COpen%20Sans%3A400%2C300%2C600%2C700%2C800"
          media="screen"/>

    <link href="{{ asset('css/index.css') }}" rel="stylesheet">

    <script type="text/javascript" src="{{ asset('js/index_t.js') }}"></script>

    <script type="text/javascript"
            src="https://maps.googleapis.com/maps/api/js?key&amp;sensor=false"></script>
</head>

<body>
@include('frontend.layouts.header')
@yield('secondary_banner')
@yield('content')
<section class="content">
    <div class="container">
        <div class="inner-page full-width row">
            <div
                class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding-left-none padding-right-none">
                <div class="blog-content">
                    <div class="post-entry clearfix">
                        @yield('before-content')
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!--container ends-->
</section>
<!--content ends-->
<div class="clearfix"></div>
@include('frontend.layouts.footer')
<div class="back_to_top"><img src="{{asset('images/arrow-up.png')}}" alt="scroll up"/></div>

<script type="text/javascript" src="{{ asset('js/index_b.js') }}"></script>

</body>
</html>
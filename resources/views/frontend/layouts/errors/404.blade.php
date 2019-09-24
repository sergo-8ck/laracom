<!doctype html>
<!--[if IE 7 ]> <html lang="en" class="ie7"> <![endif]-->
<!--[if IE 8 ]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9 ]> <html lang="en" class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">
    <title>404 — страница не найдена</title>
    <!-- HTML5 shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script type="text/javascript" src="{{ asset('js/html5shivrespond.js') }}"></script>
    <![endif]-->

    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Yellowtail%7COpen%20Sans%3A400%2C300%2C600%2C700%2C800" media="screen" />
    <!-- Custom styles for this template -->

    <link href="{{ asset('css/index.css') }}" rel="stylesheet">

    <script type="text/javascript" src="{{ asset('js/index_t.js') }}"></script>
</head>
<body>
@include('frontend.layouts.header')
<section id="secondary-banner" style="background: url({{ asset('images/header/dynamic-header-21-1.jpg') }}) top center no-repeat;">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-6 col-sm-6 col-xs-12">
                <h1>404 — страница не найдена</h1>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <ul class="breadcrumb">
                    <li><a href="{{ route('home') }}">На главную</a></li>
                    <li>Страница не найдена</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!--#secondary-banner ends-->
<div class="message-shadow"></div>
<div class="clearfix"></div>
<section class="content less-margin">
    <div class="container">
        <div class="inner-page">
            <div class="error-message">
                <h2 class="error padding-10 margin-bottom-30 padding-top-none"><i class="fa fa-exclamation-circle exclamation margin-right-50"></i>404</h2>
                <p>Страница не найдена.</p>
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
@extends('frontend.layouts.app')

@section('title')404 - страница не найдена@stop
@section('title_h1')404 - страница не найдена@stop
@section('description')404 - страница не найдена@stop

@section('seo_keywords')404, траница не найдена,
@include('frontend.layouts.keywords')
@stop

@section('secondary_banner')
    <section id="secondary-banner" style="background: url({{ asset('/images/header/dynamic-header-9.jpg') }}) top center no-repeat;">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-6 col-sm-6 col-xs-12">
                    <h1>404 - страница не найдена</h1>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <ul class="breadcrumb">
                        <li><a href="{{ route('home') }}">На главную</a></li>
                        <li>404 - страница не найдена</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <div class="message-shadow"></div>
    <div class="clearfix"></div>
@endsection

@section('content')
    <section class="content less-margin">
        <div class="container">
            <div class="inner-page">
                <div class="error-message">
                    <h2 class="error padding-10 margin-bottom-30 padding-top-none"><i class="fa fa-exclamation-circle exclamation margin-right-50"></i>404</h2>
                    <p>404 - страница не найдена</p>
                </div>
            </div>
        </div>
    </section>
    <div class="clearfix"></div>
@endsection
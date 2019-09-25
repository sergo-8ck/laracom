@extends('frontend.layouts.app')

@section('title')403 - доступ запрещен@stop
@section('title_h1')403 - доступ запрещен@stop
@section('description')403 - доступ запрещен@stop

@section('seo_keywords')403, доступ запрещен, продажа авто Америки, автомобили из Америки, автомобили из Германии, автомобили из США,авто из Америки, авто из Германии, авто из Европы и СШАавто из США форум,авто из США, купить авто из США, машины из Америки, машины из США, мотоциклы из Америки, мотоциклы из Германии, мотоциклы из США, новые автомобили из Америки, новые авто из США, продажа автомобилей Америки, продажа автомобилей США, продажа авто США, сайт продажи авто в США, спец техника из Америки, спец техника из США@stop

@section('secondary_banner')
    <section id="secondary-banner" style="background: url({{ asset('/images/header/dynamic-header-9.jpg') }}) top center no-repeat;">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-6 col-sm-6 col-xs-12">
                    <h1>403 - доступ запрещен</h1>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <ul class="breadcrumb">
                        <li><a href="{{ route('home') }}">На главную</a></li>
                        <li>403 - доступ запрещен</li>
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
                    <h2 class="error padding-10 margin-bottom-30 padding-top-none"><i class="fa fa-exclamation-circle exclamation margin-right-50"></i>403</h2>
                    <p>403 - доступ запрещен</p>
                </div>
            </div>
        </div>
    </section>
    <div class="clearfix"></div>
@endsection
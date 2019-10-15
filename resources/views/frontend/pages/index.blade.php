@extends('frontend.layouts.app')

@section('title'){{$article->title}}@stop
@section('title_h1'){{$article->title_h1}}@stop
@section('description')@if($article->seo_description){{$article->seo_description}}@else{{$article->description}}@endif
@stop

@section('seo_keywords')@if($article->seo_keywords){{$article->seo_keywords}},@endif
@include('frontend.layouts.keywords')
@stop


@section('secondary_banner')
    @include('frontend.layouts.slider')
    <section class="message-wrap">
        <div class="container">
            <div class="row">
                <h2 class="col-lg-9 col-md-8 col-sm-12 col-xs-12 xs-padding-left-15">Позвольте найти
                    для вас идеальный <span class="alternate-font">автомобиль</span></h2>
                <div id="uvedomlenie" class="fancybox" style="display: none;">
                    <h2>{{ $uvedomlenie->title_h1 }}</h2>
                    {!! $uvedomlenie->content !!}
                </div>
                <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 xs-padding-right-15"><a href="#"
                                                                                          class="default-btn pull-right action_button lg-button">Искать</a>
                </div>
            </div>
        </div>
        <div class="message-shadow"></div>
    </section>
@endsection


@section('content')
    <section class="content">
        <div class="container">
            <div class="inner-page homepage margin-bottom-none">
                @include('frontend.layouts.tabsauction')
                @include('frontend.layouts.auctions')
                <section class="car-block-wrap padding-bottom-40">
                    <div class="container">
                        <div class="row">
                            @foreach($arts as $item)
                                <div
                                    class="col-lg-4 col-md-4 col-sm-4 col-xs-12 margin-bottom-none">
                                    <div class="flip margin-bottom-30">
                                        <div class="card">
                                            <div class="face front">
                                                <a href="{{ $item->slug }}">
                                                    <img class="img-responsive"
                                                         src="{{ asset("storage/$item->cover") }}"
                                                         alt="{{ $item->title }}">
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                    <h4><a href="#">{{ $item->name }}</a></h4>
                                    <p class="margin-bottom-none">{{ $item->description }}</p>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </section>
                <div class="clearfix"></div>
                @include('frontend.layouts.recent-vehicles')
                @include('frontend.layouts.descriptionsite')
            </div>
        </div>
    </section>
@stop


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
                <h2 class="col-lg-9 col-md-8 col-sm-12 col-xs-12 xs-padding-left-15">Позвольте найти для вас идеальный <span class="alternate-font">автомобиль</span></h2>
                <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 xs-padding-right-15"> <a href="#" class="default-btn pull-right action_button lg-button">Искать</a> </div>
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
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 margin-bottom-none">
                                <div class="flip margin-bottom-30">
                                    <div class="card">
                                        <div class="face front"><img class="img-responsive"
                                                                     src="http://demo.themesuite.com/automotive/images/car1.jpg"
                                                                     alt=""></div>
                                        <div class="face back">
                                            <div class='hover_title'>Race Ready</div>
                                            <a href="inventory-listing.html"><i
                                                    class="fa fa-link button_icon"></i></a> <a
                                                href="images/car1-lrg.jpg" class="fancybox"><i
                                                    class="fa fa-arrows-alt button_icon"></i></a></div>
                                    </div>
                                </div>
                                <h4><a href="#">FACTORY READY FOR TRACK DAY</a></h4>
                                <p class="margin-bottom-none">Sea veniam lucilius neglegentur ad, an per
                                    sumo volum
                                    voluptatibus. Qui cu everti repudiare. Eam ut cibo nobis
                                    aperiam, elit qualisque at cum. Possit antiopam id est.
                                    Illud delicata ea mel, sed novum mucius id. Nullam qua.</p>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 margin-bottom-none">
                                <div class="flip horizontal margin-bottom-30">
                                    <div class="card">
                                        <div class="face front"><img class="img-responsive"
                                                                     src="http://demo.themesuite.com/automotive/images/car2.jpg"
                                                                     alt=""></div>
                                        <div class="face back">
                                            <div class='hover_title'>Family Oriented</div>
                                            <a href="inventory-listing.html"><i
                                                    class="fa fa-link button_icon"></i></a> <a
                                                href="images/car2-lrg.jpg" class="fancybox"><i
                                                    class="fa fa-arrows-alt button_icon"></i></a></div>
                                    </div>
                                </div>
                                <h4><a href="#">A SPORT UTILITY FOR THE FAMILY</a></h4>
                                <p class="margin-bottom-none">Cum ut tractatos imperdiet, no tamquam
                                    facilisi qui.
                                    Eum tibique consectetuer in, an legimus referrentur vis,
                                    vocent deseruisse ex mel. Sed te idque graecis. Vel ne
                                    libris dolores, in mel graece dolorum.</p>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 margin-bottom-none">
                                <div class="flip margin-bottom-30">
                                    <div class="card">
                                        <div class="face front"><img class="img-responsive"
                                                                     src="http://demo.themesuite.com/automotive/images/car3.jpg"
                                                                     alt=""></div>
                                        <div class="face back">
                                            <div class='hover_title'>World Class</div>
                                            <a href="inventory-listing.html"><i
                                                    class="fa fa-link button_icon"></i></a> <a
                                                href="images/car3-lrg.jpg" class="fancybox"><i
                                                    class="fa fa-arrows-alt button_icon"></i></a></div>
                                    </div>
                                </div>
                                <h4><a href="#">MAKE AN EXECUTIVE STATEMENT</a></h4>
                                <p class="margin-bottom-none">Te inermis cotidieque cum, sed ea utroque
                                    atomorum
                                    sadipscing. Qui id oratio everti scaevola, vim ea augue
                                    ponderum vituperatoribus, quo adhuc abhorreant
                                    omittantur ad. No his fierent perpetua consequat, et nis.</p>
                            </div>
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


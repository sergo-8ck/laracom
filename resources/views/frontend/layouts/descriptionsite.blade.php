<section class="welcome-wrap padding-top-30 sm-horizontal-15">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 welcome padding-left-none padding-bottom-40">
            <h1>{{$article->title_h1}}</h1>
            {!! $article->content !!}
        </div>
        <!--welcome ends-->
        <div
            class="col-lg-4 col-md-4 col-sm-12 col-xs-12 padding-right-none sm-padding-left-none md-padding-left-15 xs-padding-left-none padding-bottom-40"
            style="z-index:100">
            <h4 class="margin-bottom-25 margin-top-none">Отзывы</h4>
            @include('frontend.layouts.testimonials')
        </div>
    </div>
</section>
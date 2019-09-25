<section id="secondary-banner" style="background: url(@if($article->background){{ asset("storage/$article->background") }}@else{{ asset('images/header/dynamic-header-9.jpg') }}@endif) top center no-repeat;">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                <div class="h1">@yield('title_h1')</div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 ">
                <ul class="breadcrumb">
                    <li><a href="{{ route('home') }}"> <i class="fa fa-home"></i> Главная</a></li>
                    @if(isset($section))
                        <li><a href="{{ route('front.section.slug', $section->slug) }}">{{ $section->name }}</a></li>
                    @endif
                    <li class="active">Статья</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<div class="message-shadow"></div>
<div class="clearfix"></div>
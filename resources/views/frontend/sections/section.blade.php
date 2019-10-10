@extends('frontend.layouts.app')

@section('og')
    <meta property="og:type" content="section"/>
    <meta property="og:title" content="{{ $section->name }}"/>
    <meta property="og:description" content="{{ $section->description }}"/>
    @if(!is_null($section->cover))
        <meta property="og:image" content="{{ asset("storage/$section->cover") }}"/>
    @endif
@endsection

@section('title'){{ $section->title }}@stop
@section('title_h1'){{$section->title_h1}}@stop
@section('description')@if($section->description){{$section->seo_description}}@else{{$section->description}}@endif
@stop

@section('seo_keywords')@if($section->seo_keywords){{$section->seo_keywords}},@endif
@include('frontend.layouts.keywords')
@stop

@section('secondary_banner')
    @include('frontend.layouts.secondary', ['article' => $section])
@endsection

@section('content')
    <section class="content">
        <div class="container">
            <div class="inner-page full-width-sidebar row">
                <div class="col-lg-3 col-md-3 col-sm-3 xs-padding-left-none">
                    @include('frontend.layouts.sidebar')
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 xs-margin-bottom-50">
                    <div class="blog-content">
                        <div class="post-entry clearfix">
                            <div class="col-lg-12"> @if($section->cover)<img src="{{ asset("storage/$section->cover") }}" alt="{{ $section->title_h1 }}" />@endif
                                <div class="blog-title">
                                    <h1>{{ $section->title_h1 }}</h1>
                                </div>
                                {!! $section->content !!}
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div>
                        @include('frontend.sections.article-item', ['articles' => $articles])
                    </div>
                </div>
            </div>
        </div>
        <!--container ends-->
    </section>
@endsection
@extends('frontend.layouts.app')

@section('title'){{$article->title}}@stop
@section('title_h1'){{$article->title_h1}}@stop
@section('description')@if($article->seo_description){{$article->seo_description}}@else{{$article->description}}@endif
@stop

@section('seo_keywords')@if($article->seo_keywords){{$article->seo_keywords}},@endif
@include('frontend.layouts.keywords')
@stop

@section('secondary_banner')
    @include('frontend.layouts.secondary', ['article' => $article])
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
                            <div class="col-lg-12"> @if($article->cover)<img src="{{ asset("storage/$article->cover") }}" alt="{{ $article->title_h1 }}" />@endif
                                <div class="blog-title">
                                    <h1 class="margin-top-40">{{ $article->title_h1 }}</h1>
                                </div>
                                {!! $article->content !!}
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!--container ends-->
    </section>
@endsection
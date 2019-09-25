@extends('frontend.layouts.blog')

@section('title'){{$article->title}}@stop
@section('title_h1'){{$article->title_h1}}@stop
@section('description')@if($article->seo_description){{$article->seo_description}}@else{{$article->description}}@endif
@stop

@section('seo_keywords')@if($article->seo_keywords){{$article->seo_keywords}},@endifпродажа авто Америки, автомобили из Америки, автомобили из Германии, автомобили из США,авто из Америки, авто из Германии, авто из Европы и СШАавто из США форум,авто из США, купить авто из США, машины из Америки, машины из США, мотоциклы из Америки, мотоциклы из Германии, мотоциклы из США, новые автомобили из Америки, новые авто из США, продажа автомобилей Америки, продажа автомобилей США, продажа авто США, сайт продажи авто в США, спец техника из Америки, спец техника из США@stop

@section('content')
    <div class="blog-content">
        <div class="post-entry clearfix">
            <div class="col-lg-12"> <img src="{{ asset("storage/$article->cover") }}" alt="" />
                <div class="blog-title">
                    <h1 class="margin-top-40">{{ $article->title_h1 }}</h1>
                </div>
                {!! $article->content !!}
            </div>
        </div>
    </div>
@endsection
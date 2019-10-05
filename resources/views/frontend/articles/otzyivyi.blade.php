@extends('frontend.layouts.app')

@section('title'){{$article->title}}@stop
@section('title_h1'){{$article->title_h1}}@stop
@section('description')@if($article->seo_description){{$article->seo_description}}@else{{$article->description}}@endif
@stop

@section('seo_keywords')@if($article->seo_keywords){{$article->seo_keywords}},@endif
@include('frontend.layouts.keywords')
@stop

@section('secondary_banner')
    @include('frontend.layouts.secondary')
@endsection

@section('content')
    @include('frontend.layouts.content_reviews')
@endsection
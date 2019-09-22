@extends('layouts.front.app')

@section('og')
    <meta property="og:type" content="article"/>
    <meta property="og:title" content="{{ $article->name }}"/>
    <meta property="og:description" content="{{ strip_tags($article->description) }}"/>
    @if(!is_null($article->cover))
        <meta property="og:image" content="{{ asset("storage/$article->cover") }}"/>
    @endif
@endsection

@section('content')
    <div class="container article">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li><a href="{{ route('home') }}"> <i class="fa fa-home"></i> Home</a></li>
                    @if(isset($section))
                    <li><a href="{{ route('front.section.slug', $section->slug) }}">{{ $section->name }}</a></li>
                    @endif
                    <li class="active">Article</li>
                </ol>
            </div>
        </div>
        @include('layouts.front.article')
    </div>
@endsection
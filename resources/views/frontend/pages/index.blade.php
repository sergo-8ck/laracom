@extends('frontend.layouts.home')

@section('title_h1')
    {{ $article->title_h1 }}
@endsection


@section('content')
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 welcome padding-left-none padding-bottom-40">
        <h1>{{$article->title_h1}}</h1>
        {!! $article->content !!}
    </div>
@stop


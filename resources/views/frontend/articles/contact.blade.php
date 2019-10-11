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
    <section class="content">
        <div class="container">
            <div class="inner-page">
                <div class="col-md-12 padding-none">
                    <div class="row contacts margin-top-25">
                        <div class="col-md-7 left-information">
                            <div class="contact_information information_head clearfix">
                                {!! $article->content !!}
                            </div>

                        </div>
                        <div
                            class="col-md-5 padding-right-none xs-padding-left-none sm-padding-left-none xs-margin-top-30">
                            <div class="contact_wrapper information_head">
                                <h3 class="margin-bottom-25 margin-top-none">ФОРМА ОБРАТНОЙ
                                    СВЯЗИ</h3>
                                <div class="bd-example">
                                    <form action="{{ url('sendemail/send') }}" method="post" class="ajax_form af_example">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="name">Имя</label>
                                            <input type="text" id="af_name" name="name" value=""
                                                   placeholder="Имя" class="form-control">
                                            <span class="error_name"></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" id="af_email" name="email"
                                                   value="" placeholder="Email"
                                                   class="form-control">
                                            <span class="error_email"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Телефон</label>
                                            <input type="phone" id="af_phone" name="phone"
                                                   value="" placeholder="Телефон"
                                                   class="form-control">
                                            <span class="error_phone"></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="message">Сообщение</label>
                                            <textarea id="af_message" name="message"
                                                      class="form-control"
                                                      placeholder="Сообщение"
                                                      rows="5"></textarea>
                                            <span class="error_message"></span>
                                        </div>
                                        <div class="form-group">
{{--                                                <button type="reset" class="btn btn-default">--}}
{{--                                                    Очистить--}}
{{--                                                </button>--}}
                                            <input type="submit" name="send" class="btn btn-info">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <!--container ends-->
    </section>
@endsection
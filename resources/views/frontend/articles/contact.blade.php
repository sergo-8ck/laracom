@extends('frontend.layouts.app')

@section('title'){{$article->title}}@stop
@section('title_h1'){{$article->title_h1}}@stop
@section('description')@if($article->seo_description){{$article->seo_description}}@else{{$article->description}}@endif
@stop

@section('seo_keywords')@if($article->seo_keywords){{$article->seo_keywords}},@endifпродажа авто Америки, автомобили из Америки, автомобили из Германии, автомобили из США,авто из Америки, авто из Германии, авто из Европы и СШАавто из США форум,авто из США, купить авто из США, машины из Америки, машины из США, мотоциклы из Америки, мотоциклы из Германии, мотоциклы из США, новые автомобили из Америки, новые авто из США, продажа автомобилей Америки, продажа автомобилей США, продажа авто США, сайт продажи авто в США, спец техника из Америки, спец техника из США@stop

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
                                <div class="form_contact margin-bottom-20">
                                    <form action="" method="post" class="ajax_form af_example">

                                        <div class="form-group">
                                            <div class="controls">
                                                <input type="text" id="af_name" name="name" value=""
                                                       placeholder="Имя" class="form-control">
                                                <span class="error_name"></span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="controls">
                                                <input type="email" id="af_email" name="email"
                                                       value="" placeholder="Email"
                                                       class="form-control">
                                                <span class="error_email"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="controls">
                                                <input type="phone" id="af_phone" name="phone"
                                                       value="" placeholder="Телефон"
                                                       class="form-control">
                                                <span class="error_phone"></span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="controls">
                                                <textarea id="af_message" name="message"
                                                          class="form-control"
                                                          placeholder="Сообщение"
                                                          rows="5"></textarea>
                                                <span class="error_message"></span>
                                            </div>
                                        </div>
                                        <div class="g-recaptcha"
                                             data-sitekey="6LdN0EUUAAAAAGsfoY9qsSFptQS--BEDXjo3zrye">
                                            <div style="width: 304px; height: 78px;">
                                                <textarea id="g-recaptcha-response"
                                                          name="g-recaptcha-response"
                                                          class="g-recaptcha-response"
                                                          style="width: 250px; height: 40px; border: 1px solid rgb(193, 193, 193); margin: 10px 25px; padding: 0px; resize: none; display: none;"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="controls">
                                                <button type="reset" class="btn btn-default">
                                                    Очистить
                                                </button>
                                                <button type="submit" class="btn btn-danger">
                                                    Отправить
                                                </button>
                                            </div>
                                        </div>
                                        <input type="hidden" name="af_action"
                                               value="229d9aae02fecd48b5bcd5ad4022d472">
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
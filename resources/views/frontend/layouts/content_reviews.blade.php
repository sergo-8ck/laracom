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
                            @include('frontend.layouts.reviews')
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!--container ends-->
</section>
<div class="clearfix"></div>
<div class="side-widget">
    <div class="side-content">
        <form class="search-box padding-bottom-50" role="search">
            <h3 class="margin-bottom-25">ПОИСК</h3>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Поиск по...">
            </div>
            <input type="submit" value="Поиск" class="margin-top-10 margin-bottom-none md-button">
        </form>
        @include('frontend.layouts.menu')
        <div class="list padding-bottom-50">
            <h3 class="margin-bottom-25">Отзывы</h3>
            @include('frontend.layouts.testimonials')
        </div>
        <div class="clearfix"></div>
    </div>
</div>
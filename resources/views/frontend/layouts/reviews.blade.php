<div class="comments margin-top-30 margin-bottom-40">
    <h3>Отзывы</h3>
    <div id="comments-wrapper">
        <div class="comment-list" id="comments">
            @php
                $traverse = function ($reviews) use (&$traverse) {
                    echo '<ol class="comment-list">';
                    foreach ($reviews as $review) {
                        echo '<li class="ticket-comment" id="comment-';
                        echo $review->id;
                        echo '"><div class="comment-profile clearfix margin-top-30 ticket-comment-body ticket-comment-guest"> <div class="col-lg-1 col-md-1 col-sm-1col-xs-1 threadauthor">
                                <div class="ticket-comment-dot-wrapper">
                                    <div class="ticket-comment-dot"></div>
                                </div>
                                <img src="images/no-avatar.png" alt="нет аватара">
                            </div>
                            <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11">
                                <div class="comment-data">
                                    <div class="comment-author clearfix">
                                        <strong class="ticket-comment-author">';
                                        echo $review->customer->name;
                                        echo '</strong>
                                        <span class="ticket-comment-link"><a href="/otzyivyi#comment-';
                                        echo $review->id;
                                        echo '">#</a></span>
                                        <span class="comment-reply">
                            <a href="#" class="reply" data-parent="';
                            echo $review->id;
                            echo '">ответить</a></span>
                            <span class="ticket-comment-rating inactive">';
                            if(auth()->check() and auth()->user()->id == $review->customer_id){
                                echo '<form action="';
                                echo route('otzyivyi.destroy', $review->id);
                                echo '" method="post" class="form-horizontal">';
                                    echo csrf_field();
                                    echo '<input type="hidden" name="_method" value="delete">
                                    <div class="btn-group">
                                        <button onclick="return confirm(\'Вы уверены?\')" style="margin: 10px;" type="submit" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Удалить</button>
                                    </div>
                                </form>';
                            }
                            echo '</span>
                                    </div>

                                    <div class="ticket-comment-text comment-text">';
                        echo $review->body;
                        echo '<div>';
                            foreach($review->images()->get(['src']) as $image){
                                echo '<div class="col-md-3 box-img">
                                    <div class="row">
                                        <a class="fancybox" href="';
                                echo asset("storage/$image->src");
                                echo '"><img src="';
                                echo asset("storage/$image->src");
                                echo '" alt="" class="img-responsive img-thumbnail"></a>
                                    </div>
                                </div>';
                            }
                        echo '</div>';
                        $traverse($review->children);
                        echo '
                                    </div>
                                </div>
                            </div></div></li>';
                    }
                    echo '</ol>';
                };

                $traverse($reviews);
                $customer = auth()->user();
            @endphp
        </div>
        @if(auth()->check())
        <div class="leave-comments clearfix xs-margin-bottom-40">
            <h4 id="comment-new-link" style="display: none;">
                <a href="#" class="btn btn-default">Написать <ко></ко>мментарий</a>
            </h4>
            <h3 class="margin-bottom-20">ОСАВИТЬ ОТЗЫВ</h3>
            <div class="commint-form-placeholder">
                <div class="box">
                    <form action="{{ route('otzyivyi.store', $customer->id) }}" method="post" class="form" enctype="multipart/form-data">
                        <input type="hidden" name="status" value="1">
                        <input type="hidden" name="parent" value="0">
                        <div class="box-body">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="body">Отзыв <span class="text-danger">*</span></label>
                                <textarea name="body" id="comment-editor" class="form-control" cols="30" rows="10">{{ old('body') }}</textarea>
                            </div>
                            <div class="row"></div>
                            <div class="form-group">
                                <label for="image">Картинки</label><br>
                                <input type="file" name="image[]" id="image" class="form-control" multiple style="padding: 8px;"><br><br>
                                <small class="text-warning">You can use ctr (cmd) to select multiple images</small><br>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <div class="btn-group">
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @else
            <p><a href="{{ route('login') }}">Авторизируйтесь</a>, чтобы оставить отзыв.</p>
        @endif
    </div>
    <div id="comments-tpanel">
        <div id="tpanel-refresh"></div>
        <div id="tpanel-new"></div>
    </div>
</div>
<script>
    $(document).ready(function () {
      $(".reply").click(function() {
        $('html,body').animate({
            scrollTop: $(".leave-comments").offset().top},
          'slow');
        var parent = $(this).attr("data-parent");
        $('input[name=parent]').val(parent);
      });
      // $('#thumbnails li img').on('click', function () {
      //   $('#main-image')
      //     .attr('src', $(this).attr('src') +'?w=400')
      //     .attr('data-zoom', $(this).attr('src') +'?w=1200');
      // });
    });
</script>
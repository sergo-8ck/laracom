<div class="comments margin-top-30 margin-bottom-40">
    <h3>Ответы на ваши вопросы</h3>
    <div id="comments-wrapper">
        <div class="comment-list" id="comments">
            @php
                $traverse = function ($reviews) use (&$traverse) {
                    echo '<ol class="comment-list">';
                    foreach ($reviews as $review) {
                        echo '<li class="ticket-comment"><div class="comment-profile clearfix margin-top-30 ticket-comment-body ticket-comment-guest"> <div class="col-lg-1 col-md-1 col-sm-1col-xs-1 threadauthor">
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
                                    </div>
                                    <div class="ticket-comment-text comment-text">';
                        echo $review->body;
                        $traverse($review->children);
                        echo '
                                    </div>
                                </div>
                            </div></div></li>';
                    }
                    echo '</ol>';
                };

                $traverse($reviews);
            @endphp
        </div>
    </div>
    <div id="comments-tpanel">
        <div id="tpanel-refresh"></div>
        <div id="tpanel-new"></div>
    </div>
</div>
<div class="comments margin-top-30 margin-bottom-40">
    <h3>Ответы на ваши вопросы</h3>
    <div id="comments-wrapper">
        <div class="comment-list" id="comments">
            <ol class="comment-list">

                @foreach($questions as $question)
                    <li class="ticket-comment" id="comment-{{ $question->id }}" data-newparent="0" data-id="{{ $question->id }}">
                        <div class="comment-profile clearfix margin-top-30 ticket-comment-body ticket-comment-guest">

                            <div class="col-lg-1 col-md-1 col-sm-1col-xs-1 threadauthor">
                                <div class="ticket-comment-dot-wrapper">
                                    <div class="ticket-comment-dot"></div>
                                </div>
                                <img src="images/no-avatar.png" alt="нет аватара">
                            </div>
                            <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11">
                                <div class="comment-data">
                                    <div class="comment-author clearfix">
                                        <strong class="ticket-comment-author">{{ $question->author }}</strong>
                                    </div>
                                    <div class="ticket-comment-text comment-text">
                                        {{ $question->question }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($question->answer)
                        <ol class="comments-list"><li class="ticket-comment" id="comment-{{ $question->id }}" data-parent="{{ $question->id }}" data-id="{{ $question->id }}">
                                <div class="comment-profile clearfix margin-top-30 ticket-comment-body">

                                    <div class="col-lg-1 col-md-1 col-sm-1col-xs-1 threadauthor">
                                        <div class="ticket-comment-dot-wrapper">
                                            <div class="ticket-comment-dot"></div>
                                        </div>
                                        <img src="images/auto-iz-usa.png" alt="">
                                    </div>
                                    <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11">
                                        <div class="comment-data">
                                            <div class="comment-author clearfix">
                                                <strong class="ticket-comment-author">Сергей</strong>
                                            </div>
                                            <div class="ticket-comment-text comment-text">
                                                {{ $question->answer }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <ol class="comments-list"></ol>
                            </li></ol>
                        @endif
                    </li>
                @endforeach

            </ol>
        </div>
    </div>
    <div id="comments-tpanel">
        <div id="tpanel-refresh"></div>
        <div id="tpanel-new"></div>
    </div>
</div>
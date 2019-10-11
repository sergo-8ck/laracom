<div class="testimonial">
    <ul class="testimonial_slider">
        @foreach($reviews as $review)
            <li>
                <blockquote class="style1">
                    <strong>
                        <a href="otzyivyi#comment-{{ $review->id }}">{{ $review->customer->name }}</a>
                    </strong>
                    <span>
                        {!! str_limit($review->body, 500) !!}
                    </span>
                </blockquote>
            </li>
        @endforeach
    </ul>
</div>
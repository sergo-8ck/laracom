<ul class="nav sidebar-menu">
    @foreach($articles as $article)
        @if($section->children()->count() > 0)
            <li>@include('layouts.front.section-sidebar-sub', ['subs' => $section->children])</li>
        @else
        <li @if(request()->segment(2) == $article->slug) class="active" @endif><a href="{{ route('front.get.article', $article->slug) }}">{{ $article->name }}</a></li>
        @endif
    @endforeach
</ul>
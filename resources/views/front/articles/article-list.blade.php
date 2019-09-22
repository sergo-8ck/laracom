@if(!empty($articles) && !collect($articles)->isEmpty())
    <ul class="row text-center list-unstyled">
        @foreach($articles as $article)
            <li class="col-md-3 col-sm-6 col-xs-12 article-list">
                <div class="single-article">
                    <div class="article">
                        <div class="article-overlay">
                            <div class="vcenter">
                                <div class="centrize">
                                    <ul class="list-unstyled list-group">
                                        <li>
                                            <form action="{{ route('cart.store') }}" class="form-inline" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="quantity" value="1" />
                                                <input type="hidden" name="article" value="{{ $article->id }}">
                                                <button id="add-to-cart-btn" type="submit" class="btn btn-warning" data-toggle="modal" data-target="#cart-modal"> <i class="fa fa-cart-plus"></i> Add to cart</button>
                                            </form>
                                        </li>
                                        <li>  <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal_{{ $article->id }}"> <i class="fa fa-eye"></i> Quick View</button>
                                        <li>  <a class="btn btn-default article-btn" href="{{ route('front.get.article', str_slug($article->slug)) }}"> <i class="fa fa-link"></i> Go to article</a> </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @if(isset($article->cover))
                            <img src="{{ asset($article->cover) }}" alt="{{ $article->name }}" class="img-bordered img-responsive">
                        @else
                            <img src="https://placehold.it/263x330" alt="{{ $article->name }}" class="img-bordered img-responsive" />
                        @endif
                    </div>

                    <div class="article-text">
                        <h4>{{ $article->name }}</h4>
                        <p>
                            {{ config('cart.currency') }}
                            @if(!is_null($article->attributes->where('default', 1)->first()))
                                @if(!is_null($article->attributes->where('default', 1)->first()->sale_price))
                                    {{ number_format($article->attributes->where('default', 1)->first()->sale_price, 2) }}
                                    <p class="text text-danger">Sale!</p>
                                @else
                                    {{ number_format($article->attributes->where('default', 1)->first()->price, 2) }}
                                @endif
                            @else
                                {{ number_format($article->price, 2) }}
                            @endif
                        </p>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="myModal_{{ $article->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                @include('layouts.front.article')
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        @endforeach
        @if($articles instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator)
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-left">{{ $articles->links() }}</div>
                </div>
            </div>
        @endif
    </ul>
@else
    <p class="alert alert-warning">No articles yet.</p>
@endif
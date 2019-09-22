<div class="row">
    <div class="col-md-6">
        <ul id="thumbnails" class="col-md-4 list-unstyled">
            <li>
                <a href="javascript: void(0)">
                    @if(isset($article->cover))
                    <img class="img-responsive img-thumbnail"
                         src="{{ asset("storage/$article->cover") }}"
                         alt="{{ $article->name }}" />
                    @else
                    <img class="img-responsive img-thumbnail"
                         src="{{ asset("https://placehold.it/180x180") }}"
                         alt="{{ $article->name }}" />
                    @endif
                </a>
            </li>
            @if(isset($images) && !$images->isEmpty())
                @foreach($images as $image)
                <li>
                    <a href="javascript: void(0)">
                    <img class="img-responsive img-thumbnail"
                         src="{{ asset("storage/$image->src") }}"
                         alt="{{ $article->name }}" />
                    </a>
                </li>
                @endforeach
            @endif
        </ul>
        <figure class="text-center article-cover-wrap col-md-8">
            @if(isset($article->cover))
                <img id="main-image" class="article-cover img-responsive"
                     src="{{ asset("storage/$article->cover") }}?w=400"
                     data-zoom="{{ asset("storage/$article->cover") }}?w=1200">
            @else
                <img id="main-image" class="article-cover" src="https://placehold.it/300x300"
                     data-zoom="{{ asset("storage/$article->cover") }}?w=1200" alt="{{ $article->name }}">
            @endif
        </figure>
    </div>
    <div class="col-md-6">
        <div class="article-description">
            <h1>{{ $article->name }}
                <small>{{ config('cart.currency') }} {{ $article->price }}</small>
            </h1>
            <div class="description">{!! $article->description !!}</div>
            <div class="excerpt">
                <hr>{!!  str_limit($article->description, 100, ' ...') !!}</div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    @include('layouts.errors-and-messages')
                    <form action="{{ route('cart.store') }}" class="form-inline" method="post">
                        {{ csrf_field() }}
                        @if(isset($articleAttributes) && !$articleAttributes->isEmpty())
                            <div class="form-group">
                                <label for="articleAttribute">Choose Combination</label> <br />
                                <select name="articleAttribute" id="articleAttribute" class="form-control select2">
                                    @foreach($articleAttributes as $articleAttribute)
                                        <option value="{{ $articleAttribute->id }}">
                                            @foreach($articleAttribute->attributesValues as $value)
                                                {{ $value->attribute->name }} : {{ ucwords($value->value) }}
                                            @endforeach
                                            @if(!is_null($articleAttribute->price))
                                                ( {{ config('cart.currency_symbol') }} {{ $articleAttribute->price }})
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                            </div><hr>
                        @endif
                        <div class="form-group">
                            <input type="text"
                                   class="form-control"
                                   name="quantity"
                                   id="quantity"
                                   placeholder="Quantity"
                                   value="{{ old('quantity') }}" />
                            <input type="hidden" name="article" value="{{ $article->id }}" />
                        </div>
                        <button type="submit" class="btn btn-warning"><i class="fa fa-cart-plus"></i> Add to cart
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            var articlePane = document.querySelector('.article-cover');
            var paneContainer = document.querySelector('.article-cover-wrap');

            new Drift(articlePane, {
                paneContainer: paneContainer,
                inlinePane: false
            });
        });
    </script>
@endsection
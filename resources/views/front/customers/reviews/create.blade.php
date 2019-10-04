@extends('layouts.front.app')

@section('content')
    <!-- Main content -->
    <section class="container content">
        @include('layouts.errors-and-messages')
        <div class="box">
            <form action="{{ route('customer.review.store', $customer->id) }}" method="post" class="form" enctype="multipart/form-data">
                <input type="hidden" name="status" value="1">
                <div class="box-body">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="body">Отзыв <span class="text-danger">*</span></label>
                        <textarea name="body" id="body" class="form-control" cols="30" rows="10">{{ old('body') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="image">Картинки</label>
                        <input type="file" name="image[]" id="image" class="form-control" multiple>
                        <small class="text-warning">You can use ctr (cmd) to select multiple images</small>
                    </div>
{{--                    <div class="form-group">--}}
{{--                        <label for="review_1">Address 1 <span class="text-danger">*</span></label>--}}
{{--                        <input type="text" name="review_1" id="review_1" placeholder="Address 1" class="form-control" value="{{ old('review_1') }}">--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <label for="review_2">Address 2 </label>--}}
{{--                        <input type="text" name="review_2" id="review_2" placeholder="Address 2" class="form-control" value="{{ old('review_2') }}">--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <label for="country_id">Country </label>--}}
{{--                        <select name="country_id" id="country_id" class="form-control select2">--}}
{{--                            @foreach($countries as $country)--}}
{{--                                <option @if(env('SHOP_COUNTRY_ID') == $country->id) selected="selected" @endif value="{{ $country->id }}">{{ $country->name }}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                    <div id="provinces" class="form-group" style="display: none;"></div>--}}
{{--                    <div id="cities" class="form-group" style="display: none;"></div>--}}
{{--                    <div class="form-group">--}}
{{--                        <label for="zip">Zip Code </label>--}}
{{--                        <input type="text" name="zip" id="zip" placeholder="Zip code" class="form-control" value="{{ old('zip') }}">--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <label for="phone">Your Phone </label>--}}
{{--                        <input type="text" name="phone" id="phone" placeholder="Phone number" class="form-control" value="{{ old('phone') }}">--}}
{{--                    </div>--}}
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <div class="btn-group">
                        <a href="{{ route('accounts', ['tab' => 'review']) }}" class="btn btn-default">Back</a>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection

@section('css')
@endsection

@section('js')
@endsection

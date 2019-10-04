@extends('layouts.front.app')

@section('content')
    <!-- Main content -->
    <section class="container content">
        @include('layouts.errors-and-messages')
        <div class="box">
            <form action="{{ route('customer.review.update', [$customer->id, $review->id]) }}" method="post" class="form" enctype="multipart/form-data">
                <input type="hidden" name="status" value="1">
                <input type="hidden" name="_method" value="put">
                <div class="box-body">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="body">Отзыв <span class="text-danger">*</span></label>
                        <textarea name="body" id="body" class="form-control" cols="30" rows="10">{{ old('body') ?? $review->body}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    @foreach($images as $image)
                        <div class="col-md-3">
                            <div class="row">
                                <img src="{{ asset("storage/$image->src") }}" alt="" class="img-responsive img-thumbnail"> <br /> <br>
                                <a onclick="return confirm('Are you sure?')" href="{{ route('review.remove.thumb', ['src' => $image->src]) }}" class="btn btn-danger btn-sm btn-block">Удалить?</a><br />
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row"></div>
                <div class="form-group">
                    <label for="image">Images </label>
                    <input type="file" name="image[]" id="image" class="form-control" multiple>
                    <span class="text-warning">You can use ctr (cmd) to select multiple images</span>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <div class="btn-group">
                        <a href="{{ route('accounts', ['tab' => 'review']) }}" class="btn btn-default">Back</a>
                        <button type="submit" class="btn btn-primary">Update</button>
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

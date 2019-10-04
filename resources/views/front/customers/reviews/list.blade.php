@extends('layouts.front.app')

@section('content')
    <!-- Main content -->
    <section class="content container">
    @include('layouts.errors-and-messages')
    <!-- Default box -->
        @if($reviews)
            <div class="box">
                <div class="box-body">
                    <h2>Addresses</h2>
                    @if(!$reviews->isEmpty())
                        <table class="table">
                        <tbody>
                        <tr>
                            <td>Alias</td>
                            <td>Address 1</td>
                            @if(isset($review->province))
                            <td>Province</td>
                            @endif
                            <td>State</td>
                            <td>City</td>
                            <td>Zip Code</td>
                            <td>Country</td>
                            <td>Status</td>
                            <td>Actions</td>
                        </tr>
                        </tbody>
                        <tbody>
                        @foreach ($reviews as $review)
                            <tr>
                                <td><a href="{{ route('admin.customers.show', $customer->id) }}">{{ $review->alias }}</a></td>
                                <td>{{ $review->review_1 }}</td>
                                @if(isset($review->province))
                                <td>{{ $review->province->name }}</td>
                                @endif
                                <td>{{ $review->state_code }}</td>
                                <td>{{ $review->city }}</td>
                                <td>{{ $review->zip }}</td>
                                <td>{{ $review->country->name }}</td>
                                <td>@include('layouts.status', ['status' => $review->status])</td>
                                <td>
                                    <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="post" class="form-horizontal">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="delete">
                                        <div class="btn-group">
                                            <a href="{{ route('admin.reviews.edit', $review->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                            <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Delete</button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                        <a href="{{ route('accounts', ['tab' => 'profile']) }}" class="btn btn-default">Back to My Account</a>
                    @else
                        <p class="alert alert-warning">No review created yet. <a href="{{ route('customer.review.create', auth()->id()) }}">Create</a></p>
                    @endif
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        @else
            <div class="box">
                <div class="box-body"><p class="alert alert-warning">No reviews found.</p></div>
            </div>
        @endif
    </section>
    <!-- /.content -->
@endsection
@extends('layouts.admin.app')

@section('content')
    <!-- Main content -->
    <section class="content">

    @include('layouts.errors-and-messages')
    <!-- Default box -->
        @if($article)
            <div class="box">
                <div class="box-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <td class="col-md-2">Name</td>
                            <td class="col-md-3">Description</td>
                            <td class="col-md-3">Cover</td>
                            <td class="col-md-3">Background</td>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $article->name }}</td>
                                <td>{{ $article->description }}</td>
                                <td>
                                    @if(isset($article->cover))
                                        <img src="{{ asset("$article->cover") }}" class="img-responsive" alt="">
                                    @endif
                                </td>
                                <td>
                                    @if(isset($article->background))
                                        <img src="{{ asset("$article->background") }}" class="img-responsive" alt="">
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <div class="btn-group">
                        <a href="{{ route('admin.articles.index') }}" class="btn btn-default btn-sm">Back</a>
                    </div>
                </div>
            </div>
            <!-- /.box -->
        @endif

    </section>
    <!-- /.content -->
@endsection

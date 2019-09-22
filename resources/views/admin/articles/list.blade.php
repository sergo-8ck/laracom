@extends('layouts.admin.app')

@section('content')
    <!-- Main content -->
    <section class="content">
    @include('layouts.errors-and-messages')
    <!-- Default box -->
        @if(!$articles->isEmpty())
            <div class="box">
                <div class="box-body">
                    <h2>Статьи</h2>
                    @include('layouts.search', ['route' => route('admin.articles.index')])
                    @include('admin.shared.articles')
                    {{ $articles->links() }}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        @endif

    </section>
    <!-- /.content -->
@endsection

@extends('layouts.admin.app')

@section('content')
    <!-- Main content -->
    <section class="content">

    @include('layouts.errors-and-messages')
    <!-- Default box -->
        @if($section)
            <div class="box">
                <div class="box-body">
                    <h2>Раздел</h2>
                    <table class="table">
                        <thead>
                        <tr>
                            <td class="col-md-4">Name</td>
                            <td class="col-md-4">Description</td>
                            <td class="col-md-4">Cover</td>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $section->name }}</td>
                                <td>{{ $section->description }}</td>
                                <td>
                                    @if(isset($section->cover))
                                        <img src="{{asset("storage/$section->cover")}}" alt="section image" class="img-thumbnail">
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @if(!$sections->isEmpty())
                <hr>
                    <div class="box-body">
                        <h2>Субраздел</h2>
                        <table class="table">
                            <thead>
                            <tr>
                                <td class="col-md-3">Название</td>
                                <td class="col-md-3">Описание</td>
                                <td class="col-md-3">Картинка</td>
                                <td class="col-md-3">Действие</td>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($sections as $cat)
                                    <tr>
                                        <td><a href="{{route('admin.sections.show', $cat->id)}}">{{ $cat->name }}</a></td>
                                        <td>{{ $cat->description }}</td>
                                        <td>@if(isset($cat->cover))<img src="{{asset("storage/$cat->cover")}}" alt="section image" class="img-thumbnail">@endif</td>
                                        <td><a class="btn btn-primary" href="{{route('admin.sections.edit', $cat->id)}}"><i class="fa fa-edit"></i> Редактировать</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
                @if(!$articles->isEmpty())
                    <div class="box-body">
                        <h2>Статьи</h2>
                        @include('admin.shared.articles', ['articles' => $articles])
                    </div>
                @endif
                <!-- /.box-body -->
                <div class="box-footer">
                    <div class="btn-group">
                        <a href="{{ route('admin.sections.index') }}" class="btn btn-default btn-sm">Назад</a>
                    </div>
                </div>
            </div>
            <!-- /.box -->
        @endif

    </section>
    <!-- /.content -->
@endsection

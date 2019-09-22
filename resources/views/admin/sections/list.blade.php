@extends('layouts.admin.app')

@section('content')
    <!-- Main content -->
    <section class="content">
    @include('layouts.errors-and-messages')
    <!-- Default box -->
        @if($sections)
            <div class="box">
                <div class="box-body">
                    <h2>Разделы</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <td class="col-md-3">Name</td>
                                <td class="col-md-3">Cover</td>
                                <td class="col-md-3">Status</td>
                                <td class="col-md-3">Actions</td>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($sections as $section)
                            <tr>
                                <td>
                                    <a href="{{ route('admin.sections.show', $section->id) }}">{{ $section->name }}</a></td>
                                <td>
                                    @if(isset($section->cover))
                                        <img src="{{ asset("storage/$section->cover") }}" alt="" class="img-responsive">
                                    @endif
                                </td>
                                <td>@include('layouts.status', ['status' => $section->status])</td>
                                <td>
                                    <form action="{{ route('admin.sections.destroy', $section->id) }}" method="post" class="form-horizontal">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="delete">
                                        <div class="btn-group">
                                            <a href="{{ route('admin.sections.edit', $section->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Редактировать</a>
                                            <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Удалить</button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $sections->links() }}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        @endif

    </section>
    <!-- /.content -->
@endsection

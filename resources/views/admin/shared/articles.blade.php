@if(!$articles->isEmpty())
    <table class="table">
        <thead>
        <tr>
            <td>ID</td>
            <td>Название</td>
            <td>Статус</td>
            <td>Действия</td>
        </tr>
        </thead>
        <tbody>
        @foreach ($articles as $article)
            <tr>
                <td>{{ $article->id }}</td>
                <td>
                    @if($admin->hasPermission('view-article'))
                        <a href="{{ route('admin.articles.edit', $article->id) }}">{{ $article->name }}</a>
                    @else
                        {{ $article->name }}
                    @endif
                </td>
                <td>@include('layouts.status', ['status' => $article->status])</td>
                <td>
                    <form action="{{ route('admin.articles.destroy', $article->id) }}" method="post" class="form-horizontal">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="delete">
                        <div class="btn-group">
                            @if($admin->hasPermission('update-article'))<a href="{{ route('admin.articles.edit', $article->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Редактировать</a>@endif
                            @if($admin->hasPermission('delete-article'))<button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Удалить</button>@endif
                        </div>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
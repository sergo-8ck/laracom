@extends('layouts.admin.app')

@section('content')
    <!-- Main content -->
    <section class="content">
        @include('layouts.errors-and-messages')
        <div class="box">
            <form action="{{ route('admin.articles.store') }}" method="post" class="form" enctype="multipart/form-data">
                <div class="box-body">
                    {{ csrf_field() }}
                    <div class="col-md-8">
                        <h2>Статья</h2>
                        <div class="form-group">
                            <label for="name">Название <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" placeholder="Name" class="form-control" value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label for="title">Заголовок <span class="text-danger">*</span></label>
                            <input type="text" name="title" id="title" placeholder="Title" class="form-control" value="{{ old('title') }}">
                        </div>
                        <div class="form-group">
                            <label for="title_h1">H1 <span class="text-danger">*</span></label>
                            <input type="text" name="title_h1" id="title_h1" placeholder="H1" class="form-control" value="{{ old('title_h1') }}">
                        </div>
                        <div class="form-group">
                            <label for="description">Короткое описание </label>
                            <textarea class="form-control" name="description" id="description" rows="5" placeholder="Короткое описание">{{ old('description') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="content">Полное описание </label>
                            <textarea class="form-control ckeditor" name="content" id="description" rows="5" placeholder="Content">{{ old('content') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="seo_keywords">Ключевики </label>
                            <textarea class="form-control" name="seo_keywords" id="seo_keywords" rows="5" placeholder="Ключевые слова">{{ old('seo_keywords') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="seo_description">Сео описание </label>
                            <textarea class="form-control" name="seo_description" id="seo_description" rows="5" placeholder="СЕО описание">{{ old('seo_description') }}</textarea>
                        </div>
                        <div class="form-group">
                                <label for="cover">Cover </label>
                            <input type="file" name="cover" id="cover" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="background">Background </label>
                            <input type="file" name="background" id="background" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="image">Картинки</label>
                            <input type="file" name="image[]" id="image" class="form-control" multiple>
                            <small class="text-warning">You can use ctr (cmd) to select multiple images</small>
                        </div>
                        @include('admin.shared.status-select', ['status' => 0])
                    </div>
                    <div class="col-md-4">
                        <h2>Категории</h2>
                        @include('admin.shared.sections', ['sections' => $sections, 'selectedIds' => []])
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <div class="btn-group">
                        <a href="{{ route('admin.articles.index') }}" class="btn btn-default">Назад</a>
                        <button type="submit" class="btn btn-primary">Создать</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection

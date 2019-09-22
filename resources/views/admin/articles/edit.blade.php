@extends('layouts.admin.app')

@section('content')
    <!-- Main content -->
    <section class="content">
        @include('layouts.errors-and-messages')
        <div class="box">
            <form action="{{ route('admin.articles.update', $article->id) }}" method="post" class="form" enctype="multipart/form-data">
                <div class="box-body">
                    <div class="row">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="put">
                        <div class="col-md-12">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist" id="tablist">
                                <li role="presentation" @if(!request()->has('combination')) class="active" @endif><a href="#info" aria-controls="home" role="tab" data-toggle="tab">Общее</a></li>
                                <li role="presentation" @if(request()->has('info')) class="active" @endif><a href="#combinations" aria-controls="profile" role="tab" data-toggle="tab">СЕО</a></li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content" id="tabcontent">
                                <div role="tabpanel" class="tab-pane  active" id="info">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h2>{{ ucfirst($article->name) }}</h2>
                                            <div class="form-group">
                                                <label for="name">Название <span class="text-danger">*</span></label>
                                                <input type="text" name="name" id="name" placeholder="Name" class="form-control" value="{!! $article->name !!}">
                                            </div>
                                            <div class="form-group">
                                                <label for="slug">Slug <span class="text-danger">*</span></label>
                                                <input type="text" name="slug" id="slug" placeholder="slug" class="form-control" value="{!! $article->slug !!}">
                                            </div>
                                            <div class="form-group">
                                                <label for="title_h1">H1 </label>
                                                <input type="text" name="title_h1" id="title_h1" placeholder="H1" class="form-control" value="{!! $article->title_h1 !!}">
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Краткое описание </label>
                                                <textarea class="form-control" name="description" id="description" rows="5" placeholder="Description">{!! $article->description  !!}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="content">Полное описание </label>
                                                <textarea class="form-control ckeditor" name="content" id="content" rows="5" placeholder="Полное описание">{!! $article->content  !!}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-3">
                                                    <div class="row">
                                                        <img src="{{ $article->cover }}" alt="" class="img-responsive img-thumbnail">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row"></div>
                                            <div class="form-group">
                                                <label for="cover">Cover </label>
                                                <input type="file" name="cover" id="cover" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-3">
                                                    <div class="row">
                                                        <img src="{{ $article->background }}" alt="" class="img-responsive img-thumbnail">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row"></div>
                                            <div class="form-group">
                                                <label for="background">Background </label>
                                                <input type="file" name="background" id="background" class="form-background">
                                            </div>
                                            <div class="form-group">
                                                @foreach($images as $image)
                                                    <div class="col-md-3">
                                                        <div class="row">
                                                            <img src="{{ asset("storage/$image->src") }}" alt="" class="img-responsive img-thumbnail"> <br /> <br>
                                                            <a onclick="return confirm('Are you sure?')" href="{{ route('admin.article.remove.thumb', ['src' => $image->src]) }}" class="btn btn-danger btn-sm btn-block">Удалить?</a><br />
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
                                            <div class="form-group">
                                                @include('admin.shared.status-select', ['status' => $article->status])
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                        <div class="col-md-4">
                                            <h2>Разделы</h2>
                                            @include('admin.shared.sections', ['sections' => $sections, 'ids' => $article])
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="box-footer">
                                            <div class="btn-group">
                                                <a href="{{ route('admin.articles.index') }}" class="btn btn-default btn-sm">Назад</a>
                                                <button type="submit" class="btn btn-primary btn-sm">Обновить</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="combinations">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h2>{{ ucfirst($article->name) }}</h2>
                                            <div class="form-group">
                                                <label for="title">Title </label>
                                                <input type="text" name="title" id="title" placeholder="Тайтл" class="form-control" value="{!! $article->title !!}">
                                            </div>
                                            <div class="form-group">
                                                <label for="seo_keywords">Ключевики </label>
                                                <textarea class="form-control" name="seo_keywords" id="seo_keywords" rows="5" placeholder="Ключевики">{!! $article->seo_keywords  !!}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="seo_description">Description </label>
                                                <textarea class="form-control" name="seo_description" id="seo_description" rows="5" placeholder="СЕО Описание">{!! $article->seo_description  !!}</textarea>
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="box-footer">
                                            <div class="btn-group">
                                                <a href="{{ route('admin.articles.index') }}" class="btn btn-default btn-sm">Назад</a>
                                                <button type="submit" class="btn btn-primary btn-sm">Обновить</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
@endsection
@section('css')
    <style type="text/css">
        label.checkbox-inline {
            padding: 10px 5px;
            display: block;
            margin-bottom: 5px;
        }
        label.checkbox-inline > input[type="checkbox"] {
            margin-left: 10px;
        }
        ul.attribute-lists > li > label:hover {
            background: #3c8dbc;
            color: #fff;
        }
        ul.attribute-lists > li {
            background: #eee;
        }
        ul.attribute-lists > li:hover {
            background: #ccc;
        }
        ul.attribute-lists > li {
            margin-bottom: 15px;
            padding: 15px;
        }
    </style>
@endsection
@section('js')
    <script type="text/javascript">
        function backToInfoTab() {
            $('#tablist > li:first-child').addClass('active');
            $('#tablist > li:last-child').removeClass('active');

            $('#tabcontent > div:first-child').addClass('active');
            $('#tabcontent > div:last-child').removeClass('active');
        }
        $(document).ready(function () {
            const checkbox = $('input.attribute');
            $(checkbox).on('change', function () {
                const attributeId = $(this).val();
                if ($(this).is(':checked')) {
                    $('#attributeValue' + attributeId).attr('disabled', false);
                } else {
                    $('#attributeValue' + attributeId).attr('disabled', true);
                }
                const count = checkbox.filter(':checked').length;
                if (count > 0) {
                    $('#articleAttributeQuantity').attr('disabled', false);
                    $('#articleAttributePrice').attr('disabled', false);
                    $('#salePrice').attr('disabled', false);
                    $('#default').attr('disabled', false);
                    $('#createCombinationBtn').attr('disabled', false);
                    $('#combination').attr('disabled', false);
                } else {
                    $('#articleAttributeQuantity').attr('disabled', true);
                    $('#articleAttributePrice').attr('disabled', true);
                    $('#salePrice').attr('disabled', true);
                    $('#default').attr('disabled', true);
                    $('#createCombinationBtn').attr('disabled', true);
                    $('#combination').attr('disabled', true);
                }
            });
        });
    </script>
@endsection
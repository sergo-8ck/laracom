@extends('layouts.admin.app')

@section('content')
    <!-- Main content -->
    <section class="content">
        @include('layouts.errors-and-messages')
        <div class="box">
            <form action="{{ route('admin.sections.update', $section->id) }}" method="post" class="form" enctype="multipart/form-data">
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
                                <div role="tabpanel" class="tab-pane @if(!request()->has('combination')) active @endif" id="info">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="parent">Родительская категория</label>
                                                <select name="parent" id="parent" class="form-control select2">
                                                    <option value="0">No parent</option>
                                                    @foreach($sections as $cat)
                                                        <option @if($cat->id == $section->parent_id) selected="selected" @endif value="{{$cat->id}}">{{$cat->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Название <span class="text-danger">*</span></label>
                                                <input type="text" name="name" id="name" placeholder="Name" class="form-control" value="{!! $section->name ?: old('name')  !!}">
                                            </div>
                                            <div class="form-group">
                                                <label for="slug">Slug <span class="text-danger">*</span></label>
                                                <input type="text" name="slug" id="slug" placeholder="Slug" class="form-control" value="{!! $section->slug ?: old('slug')  !!}">
                                            </div>
                                            <div class="form-group">
                                                <label for="title_h1">H1</label>
                                                <input type="text" name="title_h1" id="title_h1" placeholder="H1" class="form-control" value="{!! $section->title_h1 ?: old('title_h1')  !!}">
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Краткое описание </label>
                                                <textarea class="form-control" name="description" id="description" rows="5" placeholder="Description">{!! $section->description ?: old('description')  !!}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="content">Полное описание </label>
                                                <textarea class="form-control ckeditor" name="content" id="content" rows="5" placeholder="Описание">{!! $section->content ?: old('content')  !!}</textarea>
                                            </div>
                                            @if(isset($section->cover))
                                                <div class="form-group">
                                                    <div class="col-md-3">
                                                        <img src="{{ asset("storage/$section->cover") }}" alt="" class="img-responsive img-thumbnail"> <br/>
                                                        <a onclick="return confirm('Are you sure?')" href="{{ route('admin.section.remove.image', ['section' => $section->id, 'field' => 'cover']) }}" class="btn btn-danger">Удалить картинку?</a>
                                                    </div>

                                                </div>
                                            @endif
                                            <div class="form-group">
                                                <label for="cover">Cover </label>
                                                <input type="file" name="cover" id="cover" class="form-control">
                                            </div>
                                            @if(isset($section->background))
                                                <div class="form-group">
                                                    <div class="col-md-3">
                                                        <img src="{{ asset("storage/$section->background") }}" alt="" class="img-responsive img-thumbnail"> <br/>
                                                        <a onclick="return confirm('Are you sure?')" href="{{ route('admin.section.remove.image', ['section' => $section->id, 'field' => 'background']) }}" class="btn btn-danger">Remove image?</a>
                                                    </div>

                                                </div>
                                            @endif
                                            <div class="form-group">
                                                <label for="background">Background </label>
                                                <input type="file" name="background" id="background" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="status">Status </label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="0" @if($section->status == 0) selected="selected" @endif>Disable</option>
                                                    <option value="1" @if($section->status == 1) selected="selected" @endif>Enable</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane @if(!request()->has('combination')) active @endif" id="combinations">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="title">Title</label>
                                                <input type="text" name="title" id="title" placeholder="title" class="form-control" value="{!! $section->title ?: old('title')  !!}">
                                            </div>
                                            <div class="form-group">
                                                <label for="seo_keywords">Ключевики </label>
                                                <textarea class="form-control" name="seo_keywords" id="seo_keywords" rows="5" placeholder="Ключевики">{!! $section->seo_keywords ?: old('seo_keywords')  !!}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="seo_description">Краткое описание </label>
                                                <textarea class="form-control" name="seo_description" id="seo_description" rows="5" placeholder="Seo Description">{!! $section->seo_description ?: old('seo_description')  !!}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <div class="btn-group">
                        <a href="{{ route('admin.sections.index') }}" class="btn btn-default">Back</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection

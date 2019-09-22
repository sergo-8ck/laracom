@extends('layouts.admin.app')

@section('content')
    <!-- Main content -->
    <section class="content">
        @include('layouts.errors-and-messages')
        <div class="box">
            <form action="{{ route('admin.sections.store') }}" method="post" class="form" enctype="multipart/form-data">
                <div class="box-body">
                    <div class="row">
                        {{ csrf_field() }}
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
                                                <label for="parent">Parent Category</label>
                                                <select name="parent" id="parent" class="form-control select2">
                                                    <option value="">-- Select --</option>
                                                    @foreach($sections as $section)
                                                        <option value="{{ $section->id }}">{{ $section->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Name <span class="text-danger">*</span></label>
                                                <input type="text" name="name" id="name" placeholder="Name" class="form-control" value="{{ old('name') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="title_h1">H1 <span class="text-danger">*</span></label>
                                                <input type="text" name="title_h1" id="title_h1" placeholder="H1" class="form-control" value="{{ old('title_h1') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Короткое описание </label>
                                                <textarea class="form-control" name="description" id="description" rows="5" placeholder="Description">{{ old('description') }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="content">Описание </label>
                                                <textarea class="form-control ckeditor" name="content" id="content" rows="5" placeholder="Content">{{ old('content') }}</textarea>
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
                                                <label for="status">Status </label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="0">Disable</option>
                                                    <option value="1">Enable</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane @if(!request()->has('combination')) active @endif" id="combinations">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="title">Тайтл <span class="text-danger">*</span></label>
                                                <input type="text" name="title" id="title" placeholder="Title" class="form-control" value="{{ old('title') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="seo_keywords">СЕО ключевики</label>
                                                <textarea class="form-control" name="seo_keywords" id="seo_keywords" rows="5" placeholder="SEO Ключевики">{{ old('seo_keywords') }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="seo_description">СЕО описание</label>
                                                <textarea class="form-control" name="seo_description" id="seo_description" rows="5" placeholder="SEO Description">{{ old('seo_description') }}</textarea>
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
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection

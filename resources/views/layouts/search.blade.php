<div class="pull-right">
    <!-- search form -->
    <form action="{{$route}}" method="get" id="admin-search">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Поиск..." value="{{ request()->input('q') }}">
            <span class="input-group-btn">
                <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i> Поиск </button>
            </span>
        </div>
    </form>
    <!-- /.search form -->
</div>

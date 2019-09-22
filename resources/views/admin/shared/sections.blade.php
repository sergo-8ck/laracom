<ul class="checkbox-list">
    @foreach($sections as $section)
        <li>
            <div class="checkbox">
                <label>
                    <input
                            type="checkbox"
                            @if(isset($selectedIds) && in_array($section->id, $selectedIds))checked="checked" @endif
                            name="sections[]"
                            value="{{ $section->id }}">
                    {{ $section->name }}
                </label>
            </div>
        </li>
        @if($section->children->count() >= 1)
            @include('admin.shared.sections', ['sections' => $section->children, 'selectedIds' => $selectedIds])
        @endif
    @endforeach
</ul>
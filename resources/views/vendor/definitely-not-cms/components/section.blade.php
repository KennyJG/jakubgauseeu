<div id="{{ 'Section-' . $section->id }}" style="background-size:cover;background-repeat:no-repeat;background-position:center center;" class="{{ 'Section-' . $section->id }}" style="z-index: 1">
    {{-- <img src="{{ asset('/storage/images/6.jpg') }}" style="width: 100%; height: auto; position:absolute;"> --}}
    @if ($section->childs()->count() !== 0 && $section->childs()->first()->type == 'ELEMENT')
        @foreach ($section->childs()->orderBy('order')->get() as $element)
            @component('vendor.definitely-not-cms.components.element', ['element' => $element])
            @endcomponent
        @endforeach
    @elseif ($section->childs()->count() !== 0)
        @foreach ($section->childs()->orderBy('order')->get() as $column)
            @component('vendor.definitely-not-cms.components.column', ['column' => $column])
            @endcomponent
        @endforeach
    @endif
</div>

<div
    @if(auth()->check())
    onmouseover="EventBus.$emit('layoutHovered', { layoutId: '{{ 'Layout-' . $column->id }}', event: event })"
    onmouseout="EventBus.$emit('layoutUnHovered', { layoutId: '{{ 'Layout-' . $column->id }}', event: event })"
    onclick="EventBus.$emit('layoutSelected', { layoutId: '{{ 'Layout-' . $column->id }}', event: event })"
    @endif
    id="{{ 'Layout-' . $column->id }}"
    style="background-size:cover;background-repeat:no-repeat;background-position:center center;z-index: 2"
    class="{{ 'Column-' . $column->id }}">
    @if ($column->childs()->count() !== 0 && $column->childs()->first()->type == 'ELEMENT')
        @foreach ($column->childs()->orderBy('order')->get() as $element)
            @component('vendor.definitely-not-cms.components.element', ['element' => $element])
            @endcomponent
        @endforeach
    @elseif ($column->childs()->count() !== 0)
        @foreach ($column->childs()->orderBy('order')->get() as $row)
            @component('vendor.definitely-not-cms.components.row', ['row' => $row])
            @endcomponent
        @endforeach
    @endif
</div>

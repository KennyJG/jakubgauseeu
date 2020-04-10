<div
    @if(auth()->check())
    onmouseover="EventBus.$emit('layoutHovered', { layoutId: '{{ 'Layout-' . $row->id }}', event: event })"
    onmouseout="EventBus.$emit('layoutUnHovered', { layoutId: '{{ 'Layout-' . $row->id }}', event: event })"
    onclick="EventBus.$emit('layoutSelected', { layoutId: '{{ 'Layout-' . $row->id }}', event: event })"
    @endif
    id="{{ 'Layout-' . $row->id }}"
    style="display:flex;background-size:cover;background-repeat:no-repeat;background-position:center center;z-index: 3"
    class="{{ 'Row-' . $row->id }}">
    @if($row->childs()->first() && $row->childs()->first()->type === 'ELEMENT')
    <div style="display: flex; flex-direction:column; width:100%;">
    @elseif($row->childs()->first() && $row->childs()->first()->type === 'COLUMN')
    <div style="display: flex; flex-direction:row; width:100%;">
    @endif
    @foreach ($row->childs()->get() as $child)
        @if($child->type === 'ELEMENT')
            @component('vendor.definitely-not-cms.components.element', ['element' => $child])
            @endcomponent
        @elseif($child->type === 'COLUMN')
            @component('vendor.definitely-not-cms.components.column', ['column' => $child])
            @endcomponent
        @endif
    @endforeach
    @if(($row->childs()->first() && $row->childs()->first()->type === 'ELEMENT') || ($row->childs()->first() && $row->childs()->first()->type === 'COLUMN'))
    </div>
    @endif
</div>

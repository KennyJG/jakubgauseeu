<div
    @if(auth()->check())
    onmouseover="EventBus.$emit('layoutHovered', { layoutId: '{{ 'Layout-' . $element->id }}', event: event })"
    onmouseout="EventBus.$emit('layoutUnHovered', { layoutId: '{{ 'Layout-' . $element->id }}', event: event })"
    onclick="EventBus.$emit('layoutSelected', { layoutId: '{{ 'Layout-' . $element->id }}', event: event })"
    @endif
    id="{{ 'Layout-' . $element->id }}"
    class="{{ 'Element-' . $element->id }}"
    style="z-index: 4">
    {{ json_decode($element->data)->value }}
</div>

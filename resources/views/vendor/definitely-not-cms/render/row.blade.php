@extends('vendor.definitely-not-cms.render.main')
@section('content')
<div id="{{ 'Layout-' . $row->id }}" style="display:flex;background-size:cover;background-repeat:no-repeat;background-position:center center;" class="{{ 'Row-' . $row->id }}" style="z-index: 3">
    <div style="display: flex; flex-direction:column; width:100%;">
        @foreach ($row->childs()->get() as $element)
            @component('vendor.definitely-not-cms.components.element', ['element' => $element])
            @endcomponent
        @endforeach
    </div>
</div>
@endsection

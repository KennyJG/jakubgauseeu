@extends('vendor.definitely-not-cms.render.main')
@section('content')
<div
    id="{{ 'Layout-' . $column->id }}"
    style="background-size:cover;background-repeat:no-repeat;background-position:center center;"
    class="{{ 'Column-' . $column->id }}"
    style="z-index: 2">
    {{-- <img src="https://opwilim.com/storage/images/25.jpeg" width="600" height="400" style="width: 100%; height: auto; positon: absolute"> --}}
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
@endsection

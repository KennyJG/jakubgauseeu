
@extends('vendor.definitely-not-cms.render.main')
@section('content')
<div id="{{ 'Layout-' . $section->id }}" style="background-size:cover;background-repeat:no-repeat;background-position:center center;" class="{{ 'Section-' . $section->id }}" style="z-index: 1">
    {{-- <img src="{{ asset('/storage/images/6.jpg') }}" style="width: 100%; height: auto; position:absolute;"> --}}
    @foreach ($section->childs()->orderBy('order')->get() as $column)
        @component('vendor.definitely-not-cms.components.column', ['column' => $column])
        @endcomponent
    @endforeach
</div>
@endsection

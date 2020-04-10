@extends('vendor.definitely-not-cms.render.main')
@section('content')
<div id="{{ 'Layout-' . $element->id }}" class="{{ 'Element-' . $element->id }}" style="z-index: 4">{{ json_decode($element->data)->value }}</div>
@endsection

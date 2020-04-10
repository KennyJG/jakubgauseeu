<div id="Page-{{ $page->id }}" style="background-size:cover;background-repeat:no-repeat;background-position:center center;" class="Page-{{ $page->id }} h-full" >
    @component('vendor.definitely-not-cms.components.menu', ['page' => $page])
    @endcomponent
    <div id="content">
        @foreach ($sections as $section)
            @component('vendor.definitely-not-cms.components.section', ['section' => $section])
            @endcomponent
        @endforeach
    </div>
</div>

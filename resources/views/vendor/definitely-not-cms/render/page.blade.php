<style>{!! $styles !!}</style>
<div id="app" style="background-size:cover;background-repeat:no-repeat;background-position:center center;" class="Page-{{ $page->id }} h-full">
    @component('vendor.definitely-not-cms.components.menu', ['page' => $page])
    @endcomponent

    @if(auth()->check())
        @if($page->screen_type == '')
        <div id="content" class="Page-{{ $page->id }}" style="background-size:cover;background-repeat:no-repeat;background-position:center center;">
            @foreach ($sections as $section)
                @component('vendor.definitely-not-cms.components.section', ['section' => $section])
                @endcomponent
            @endforeach
        </div>
        @elseif($page->screen_type == 'lg')
        <div style="background-color:gray; height: 100%; padding-top: 100px;">
            <img style="width:790px; height:600px; position: absolute; top: 50px; left: 0; right: 0; bottom: 0; margin: 0 auto;" src="{{url('/img/tablet_frame.png')}}"/>
            <div style="margin: auto; width:700px; height:500px; overflow:scroll; position:relative; background-color:white;">
                <div id="content" class="Page-{{ $page->id }}" style="background-size:cover;background-repeat:no-repeat;background-position:center center;">
                    @foreach ($sections as $section)
                        @component('vendor.definitely-not-cms.components.section', ['section' => $section])
                        @endcomponent
                    @endforeach
                </div>
            </div>
        </div>
        @elseif($page->screen_type == 'sm')
        <div style="background-color:gray; height: 100%; padding-top: 200px;">
            <img style="width:600px; height:1000px; position: absolute; top: 25px; left: 0; right: 0; bottom: 0; margin: 0 auto;" src="{{url('/img/iphone_frame.png')}}"/>
            <div style="margin: auto; width:400px; height:635px; overflow:scroll; position:relative; background-color:white;">
                <div id="content" class="Page-{{ $page->id }}" style="background-size:cover;background-repeat:no-repeat;background-position:center center;">
                    @foreach ($sections as $section)
                        @component('vendor.definitely-not-cms.components.section', ['section' => $section])
                        @endcomponent
                    @endforeach
                </div>
            </div>
        </div>
        @endif
    @else
    <div class="xl">
        <div id="content" class="Page-{{ $page->id }}" style="background-size:cover;background-repeat:no-repeat;background-position:center center;">
            @foreach ($sections as $section)
                @component('vendor.definitely-not-cms.components.section', ['section' => $section])
                @endcomponent
            @endforeach
        </div>
    </div>

    @if ($page->childrens()->where('screen_type', 'lg')->count() !== 0)
    <div class="lg">
        <div id="content" class="Page-{{ $page->childrens()->where('screen_type', 'lg')->first()->id }}" style="background-size:cover;background-repeat:no-repeat;background-position:center center;">
            @foreach ($page->childrens()->where('screen_type', 'lg')->first()->sections as $section)
                @component('vendor.definitely-not-cms.components.section', ['section' => $section])
                @endcomponent
            @endforeach
        </div>
    </div>
    @else
    <div class="lg">
        <div id="content" class="Page-{{ $page->id }}" style="background-size:cover;background-repeat:no-repeat;background-position:center center;">
            @foreach ($sections as $section)
                @component('vendor.definitely-not-cms.components.section', ['section' => $section])
                @endcomponent
            @endforeach
        </div>
    </div>
    @endif

    @if ($page->childrens()->where('screen_type', 'sm')->count() !== 0)
    <div class="sm">
        <div id="content" class="Page-{{ $page->childrens()->where('screen_type', 'sm')->first()->id }}" style="background-size:cover;background-repeat:no-repeat;background-position:center center;">
            @foreach ($page->childrens()->where('screen_type', 'sm')->first()->sections as $section)
                @component('vendor.definitely-not-cms.components.section', ['section' => $section])
                @endcomponent
            @endforeach
        </div>
    </div>
    @else
    <div class="sm">
        <div id="content" class="Page-{{ $page->id }}" style="background-size:cover;background-repeat:no-repeat;background-position:center center;">
            @foreach ($sections as $section)
                @component('vendor.definitely-not-cms.components.section', ['section' => $section])
                @endcomponent
            @endforeach
        </div>
    </div>
    @endif
    @endif
</div>

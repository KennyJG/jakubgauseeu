<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CMS Admin</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        html,
        body {
            height: 100%;
        }

        .xl {
            display: block;
        }

        .sm {
            display: none;
        }

        .lg {
            display: none;
        }

        @media only screen and (max-width: 1020px) {
            .sm {
                display: none;
            }

            .xl {
                display: none;
            }

            .lg {
                display: block;
            }
        }

        @media only screen and (max-width: 640px) {
            .xl {
                display: none;
            }

            .lg {
                display: none;
            }

            .sm {
                display: block;
            }
        }
    </style>
</head>
<body>
    <div class="h-full" id="app">
{{--        @if(auth()->check())--}}
        <page-render page-id="{{ $page->id }}"></page-render>
        <panel></panel>
{{--        @else--}}
{{--        <page-render page-id="{{ $page->id }}"></page-render>--}}
        {{-- Load static page only, maybe cached versions --}}
{{--        @endif--}}
    </div>
    {{-- Load vue only if loged in, as not loged in users have only static pages loaded. --}}
{{--    <script src="{{ env('APP_ENV') === 'local' ? 'http://localhost:8080/js/app.js' : asset('js/app.js') }}"></script>--}}
    <script src={{ asset('js/app.js') }}></script>

</body>
</html>

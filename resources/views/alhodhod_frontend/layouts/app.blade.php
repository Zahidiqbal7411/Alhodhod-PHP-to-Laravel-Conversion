<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" {!! $directionn ?? 'dir="ltr"' !!}>
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Alhodhod')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Styles --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('styles')

    @if(get_direction() === 'rtl')
        <link rel="stylesheet" href="{{ asset('css/rtl.css') }}">
    @endif
</head>
<body class="{{ get_direction() }}">

    @include('alhodhod_frontend.layouts.header')
    @include('alhodhod_frontend.layouts.hero_section')
    @include('alhodhod_frontend.layouts.add_banner')
    @include('alhodhod_frontend.layouts.dreams')

    <main>
        @yield('content')
    </main>

    @include('alhodhod_frontend.layouts.article')
    @include('alhodhod_frontend.layouts.footer')

    {{-- Scripts --}}
    <script src="{{ asset('js/app.js') }}"></script>
    


    @yield('scripts')
</body>
</html>


@include('alhodhod_frontend.layouts.header')

@include('alhodhod_frontend.layouts.hero_section')
@include('alhodhod_frontend.layouts.add_banner')

@include('alhodhod_frontend.layouts.dreams')
<main>
    @yield('content')
</main>
@include('alhodhod_frontend.layouts.article')
@yield('styles')
@yield('scripts')

@include('alhodhod_frontend.layouts.footer')

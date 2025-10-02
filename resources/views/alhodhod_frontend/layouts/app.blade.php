
@include('alhodhod_frontend.layouts.header')

@include('alhodhod_frontend.layouts.hero_section')
@include('alhodhod_frontend.layouts.add_banner')


<main>
    @yield('content')
</main>

@yield('styles')
@yield('scripts')

@include('alhodhod_frontend.layouts.footer')

<html>
<head>
    @php
        $metaPath = meta_path();

        $metaTags = DB::table('metatags')
            ->whereIn('url', [$metaPath, '/', ''])
            ->get();
    @endphp

    {{-- Dynamic Meta Tags from DB --}}
    @foreach($metaTags as $mt)
        {!! $mt->metatag_code !!}
    @endforeach

    {{-- Base Meta --}}
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">

    {{-- Title --}}
    <title>Al Hodhod</title>

    {{-- Alternate Language URLs --}}
    <link rel="alternate" hreflang="en" href="{{ base_url() }}?lang=en" />
    <link rel="alternate" hreflang="fr" href="{{ base_url() }}?lang=fr" />
    <link rel="alternate" hreflang="ar" href="{{ base_url() }}?lang=ar" />
    <link rel="canonical" href="{{ base_url() }}?lang={{ get_active_language() }}" />
    <!-- Bootstrap CSS -->


<!-- Bootstrap JS Bundle (includes Popper.js) -->



    {{-- CSS Links --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet" />

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    


    {{-- Your App's Stylesheet --}}
    {{-- <link href="{{ base_url() }}/styles.css" rel="stylesheet" /> --}}
    <link href="{{ asset('asset/css/style.css') }}" rel="stylesheet" />
    


    {{-- Optional: Inline custom CSS (move to external CSS for production) --}}
    <style>
        /* Add your inline styles here if needed */
    </style>

    
</head>
<body>
<script src="{{ asset('asset/js/main.js') }}?v={{ time() }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" defer></script>

</body>
</html>
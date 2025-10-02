<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
  <title>Alhodhod – Islamic Dreams Interpretation Dashboard</title>
  <!-- Google Font -->
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Amiri:wght@400;700&display=swap"
    rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  {{-- bootsratp 5 for pagination --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  {{-- box icon add --}}
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">


  <!-- Custom Dashboard Styles -->
  <link rel="stylesheet" href="{{ asset('styling/dashboard.css')}}">
  <!-- Global Action Buttons CSS -->
  <link rel="stylesheet" href="{{ asset('styling/action-buttons.css')}}">
  {{-- pages css --}}
  <link rel="stylesheet" href="{{ asset('styling/pages.css') }}">
  <!-- CSRF Token -->
  @stack('styles')

</head>

<body>
  <!-- Sidebar -->
  @include('layouts.sidebar')

  <!-- Main Content -->
  <main class="main">
    @include('layouts.header')
    @yield('Main-content')
  </main>

  {{-- this is the arabic input handler --}} <script src="{{ asset('js/arabic-input-handler.js') }}">
  </script>

  <!-- Session Messages for SweetAlert -->

  <!-- Scripts -->
  <script src="{{ asset('js/dashboard.js')}}"></script>
  {{-- uay hamray pass csrf token ka time period hian jo ky hum data ko store krany k leuy w8 krty hian 10 minutes
  krty hian
  --}}
  {{-- sweet alert script --}}


  {{-- SweetAlert --}}
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  @yield('scripts')
  <!-- ✅ Important for CKEditor in edit page -->


  <!-- SweetAlert Session Success -->
  @if(session('success'))
  <script>
    Swal.fire({
      icon: 'success',
      title: 'Success!',
      text: '{{ session("success") }}',
      timer: 2000,
      showConfirmButton: false,
      background: '#f0f8ff'
    });
  </script>
  @endif

  {{-- artilce script image when edit teh nshow a new image and replace the old image to view the user --}}
  {{-- in article eidt page --}}
  @stack('article-image-prview')
  <!-- Bootstrap JS (at bottom before </body>) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  @stack('script')


  {{-- this is the custom set time internval because when csrf token seestion time end thry refresh aain  --}}
  <script>
    setInterval(() => {
        fetch('{{ route('home') }}', { credentials: 'same-origin' });
    }, 600000); // Refresh every 10 min
</script>

</body>
</html>
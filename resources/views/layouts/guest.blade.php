<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="{{ asset('website/asset/favicon.jpg') }}" type="image/jpg">
    <title>@yield('title')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="..."
        crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('website/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('website/vendors/linericon/style.css') }}">
    <link rel="stylesheet" href="{{ asset('website/vendors/bootstrap-datepicker/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('website/vendors/nice-select/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('website/vendors/owl-carousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('website/vendors/lightbox/simpleLightbox.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('website/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('website/css/responsive.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.6/dist/sweetalert2.min.css" rel="stylesheet">
</head>

<body>
    @include('layouts.header2')
    @yield('konten')
    @include('layouts.footer2')
    <script src="{{ asset('website/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('website/js/popper.js') }}"></script>
    <script src="{{ asset('website/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('website/vendors/owl-carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('website/js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('website/js/mail-script.js') }}"></script>
    <script src="{{ asset('website/vendors/bootstrap-datepicker/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('website/vendors/nice-select/js/jquery.nice-select.js') }}"></script>
    <script src="{{ asset('website/js/mail-script.js') }}"></script>
    <script src="{{ asset('website/js/stellar.js') }}"></script>
    <script src="{{ asset('website/vendors/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('website/vendors/isotope/isotope-min.js') }}"></script>
    <script src="{{ asset('website/vendors/lightbox/simpleLightbox.min.js') }}"></script>
    <script src="{{ asset('website/js/custom.js') }}"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('website/js/jquery.form.js') }}"></script>
    <script src="{{ asset('website/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('website/js/contact.js') }}"></script>
    <script src="{{ asset('website/js/custom.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.6/dist/sweetalert2.min.js"></script>
    @if (session('logout'))
        <script>
            Swal.fire({
                icon: 'success',
                text: "{{ session('logout') }}",
                timer: 3000,
                showConfirmButton: true,
                willClose: () => {
                    window.location.href = '{{ url('/') }}';
                }
            });
        </script>
    @endif
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                text: "{{ session('success') }}",
                timer: 3000,
                showConfirmButton: true,
            });
        </script>
    @endif
    @if (session('login_success'))
        <script>
            Swal.fire({
                text: "{{ session('login_success') }}",
                icon: "success",
                timer: 3000,
                showConfirmButton: true,
            });
        </script>
    @endif
</body>

</html>

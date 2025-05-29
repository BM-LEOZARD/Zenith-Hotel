<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('dashboard/img/logo.jpg') }}">
    <link rel="icon" type="image/jpg" sizes="32x32" href="{{ asset('dashboard/img/logo.jpg') }}">
    <link rel="icon" type="image/jpg" sizes="16x16" href="{{ asset('dashboard/img/logo.jpg') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.6/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/vendors/styles/core.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/vendors/styles/icon-font.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard/src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard/src/plugins/datatables/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/src/plugins/cropperjs/dist/cropper.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/vendors/styles/style.css') }}">
    <style>
        .table-plus img {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 4px;
        }
    </style>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-119386393-1');
    </script>
</head>

<body>
    @include('layouts.header')
    <div class="left-side-bar">
        <div class="brand-logo">
            <a href="index.html">
                <img src="{{ asset('dashboard/asset/logo.png') }}" alt="" class="dark-logo">
                <img src="{{ asset('dashboard/asset/logo.png') }}" alt="" class="light-logo">
            </a>
            <div class="close-sidebar" data-toggle="left-sidebar-close">
                <i class="ion-close-round"></i>
            </div>
        </div>
        <div class="menu-block customscroll">
            @include('layouts.navigation')
        </div>
    </div>
    <div class="mobile-menu-overlay"></div>
    @yield('konten')
            @include('layouts.footer')
    <script src="{{ asset('dashboard/vendors/scripts/core.js') }}"></script>
    <script src="{{ asset('dashboard/vendors/scripts/script.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendors/scripts/process.js') }}"></script>
    <script src="{{ asset('dashboard/vendors/scripts/layout-settings.js') }}"></script>
    <script src="{{ asset('dashboard/src/plugins/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('dashboard/src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard/src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dashboard/src/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('dashboard/src/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dashboard/src/plugins/cropperjs/dist/cropper.js') }}"></script>
    <script src="{{ asset('dashboard/src/plugins/datatables/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('dashboard/src/plugins/datatables/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dashboard/src/plugins/datatables/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('dashboard/src/plugins/datatables/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('dashboard/src/plugins/datatables/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('dashboard/src/plugins/datatables/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('dashboard/src/plugins/datatables/js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('dashboard/vendors/scripts/datatable-setting.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.6/dist/sweetalert2.min.js"></script>
    <script>
        window.addEventListener('DOMContentLoaded', function() {
            var image = document.getElementById('image');
            var cropBoxData;
            var canvasData;
            var cropper;
            $('#modal').on('shown.bs.modal', function() {
                cropper = new Cropper(image, {
                    autoCropArea: 0.5,
                    dragMode: 'move',
                    aspectRatio: 3 / 3,
                    restore: false,
                    guides: false,
                    center: false,
                    highlight: false,
                    cropBoxMovable: false,
                    cropBoxResizable: false,
                    toggleDragModeOnDblclick: false,
                    ready: function() {
                        cropper.setCropBoxData(cropBoxData).setCanvasData(canvasData);
                    }
                });
            }).on('hidden.bs.modal', function() {
                cropBoxData = cropper.getCropBoxData();
                canvasData = cropper.getCanvasData();
                cropper.destroy();
            });
        });
    </script>
    <script>
        function showImageModal(src) {
            const modalImg = document.getElementById('modalGambar');
            modalImg.src = src;
            $('#gambarModal').modal('show');
        }
    </script>
    @stack('scripts')
</body>

</html>

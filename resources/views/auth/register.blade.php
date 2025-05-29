<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Zenith Hotel | Register</title>
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('dashboard/img/logo.jpg') }}">
    <link rel="icon" type="image/jpg" sizes="32x32" href="{{ asset('dashboard/img/logo.jpg') }}">
    <link rel="icon" type="image/jpg" sizes="16x16" href="{{ asset('dashboard/img/logo.jpg') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.6/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/vendors/styles/core.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/vendors/styles/icon-font.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/vendors/styles/style.css') }}">
    <style>
        .login-box {
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 20px;
            background-color: #fff;
            max-width: 700px;
            width: 100%;
        }

        .form-row {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .form-col {
            flex: 1 1 48%;
        }

        .input-group.custom {
            display: flex;
            flex-direction: column;
            margin-bottom: 1rem;
        }

        .input-group-inner {
            display: flex;
            align-items: center;
        }

        .input-group-text {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 46px;
            width: 46px;
            border-radius: 0.25rem 0 0 0.25rem;
            background-color: #eee;
            border: 1px solid #ccc;
            font-size: 1.2rem;
        }

        .input-group.custom input.form-control,
        .input-group.custom select.form-control {
            border-radius: 0 0.25rem 0.25rem 0;
            border: 1px solid #ccc;
            border-left: none;
            flex: 1;
            padding: 0.5rem 0.75rem;
            height: 46px;
            font-size: 1rem;
        }
    </style>
    <style>
        .password-wrapper {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            display: none;
            font-size: 1.3rem;
            color: #999;
            z-index: 2;
        }

        .toggle-password:hover {
            color: #333;
        }

        .input-group-inner {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-group-inner input {
            padding-right: 40px;
            height: 46px;
            font-size: 1rem;
        }
    </style>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
    <script>
        window.dataLayer = window.dataLayer || []

        function gtag() {
            dataLayer.push(arguments)
        }
        gtag('js', new Date())
        gtag('config', 'UA-119386393-1')
    </script>
</head>

<body class="login-page">
    <div class="login-wrap">
        <div class="login-box">
            <div class="login-title">
                <h2 class="text-center text-primary">Register</h2>
            </div>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-row">
                    <div class="form-col">
                        <div class="input-group custom">
                            <label for="name">Nama Lengkap</label>
                            <div class="input-group-inner">
                                <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                                <input type="text" name="name" id="name" class="form-control form-control-lg"
                                    placeholder="Masukkan Nama Lengkap" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="input-group custom">
                            <label for="username">Username</label>
                            <div class="input-group-inner">
                                <span class="input-group-text"><i class="icon-copy dw dw-id-card1"></i></span>
                                <input type="text" name="username" id="username"
                                    class="form-control form-control-lg" placeholder="Masukkan Username" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <div class="input-group custom">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <div class="input-group-inner">
                                <span class="input-group-text"><i class="icon-copy dw dw-user2"></i></span>
                                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control form-control-lg"
                                    required>
                                    <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="input-group custom">
                            <label for="no_hp">Nomor HP</label>
                            <div class="input-group-inner">
                                <span class="input-group-text"><i class="icon-copy dw dw-smartphone-1"></i></span>
                                <input type="text" name="no_hp" id="no_hp" class="form-control form-control-lg"
                                    placeholder="Masukkan Nomor HP" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <div class="input-group custom">
                            <label for="email">Email</label>
                            <div class="input-group-inner">
                                <span class="input-group-text"><i class="icon-copy dw dw-email"></i></span>
                                <input type="email" name="email" id="email" class="form-control form-control-lg"
                                    placeholder="Masukkan Email" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="input-group custom">
                            <label for="password">Password</label>
                            <div class="input-group-inner password-wrapper">
                                <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                                <input type="password" name="password" id="password"
                                    class="form-control form-control-lg" placeholder="Masukkan Password" required>
                                <i class="fa fa-eye-slash toggle-password" data-target="#password"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <div class="input-group custom">
                            <label for="password_confirmation">Konfirmasi Password</label>
                            <div class="input-group-inner password-wrapper">
                                <span class="input-group-text"><i class="dw dw-padlock"></i></span>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control form-control-lg" placeholder="Konfirmasi Password" required>
                                <i class="fa fa-eye-slash toggle-password" data-target="#password_confirmation"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="input-group mb-0">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">Register</button>
                        </div>
                        <div class="font-16 weight-600 pt-10 pb-10 text-center" data-color="#707373">
                            Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="{{ asset('dashboard/vendors/scripts/core.js') }}"></script>
    <script src="{{ asset('dashboard/vendors/scripts/script.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendors/scripts/process.js') }}"></script>
    <script src="{{ asset('dashboard/vendors/scripts/layout-settings.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.6/dist/sweetalert2.min.js"></script>
    @if ($errors->any())
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                title: 'Registrasi Gagal!',
                html: `{!! implode('<br>', $errors->all()) !!}`,
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
    @if (session('register_gagal'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                title: 'Registrasi Gagal!',
                text: '{{ session('register_gagal') }}',
                icon: 'error',
                timer: 3000,
                showConfirmButton: true
            });
        </script>
    @endif
    <script>
        document.querySelectorAll('.toggle-password').forEach(function(toggle) {
            const input = document.querySelector(toggle.getAttribute('data-target'));
            input.addEventListener('input', function() {
                toggle.style.display = this.value ? 'block' : 'none';
            });
            toggle.addEventListener('click', function() {
                const type = input.type === 'password' ? 'text' : 'password';
                input.type = type;
                toggle.classList.toggle('fa-eye');
                toggle.classList.toggle('fa-eye-slash');
            });
        });
    </script>
</body>

</html>

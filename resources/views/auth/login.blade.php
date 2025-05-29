<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Zenith Hotel | Login</title>
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('dashboard/img/logo.jpg') }}">
    <link rel="icon" type="image/jpg" sizes="32x32" href="{{ asset('dashboard/img/logo.jpg') }}">
    <link rel="icon" type="image/jpg" sizes="16x16" href="{{ asset('dashboard/img/logo.jpg') }}">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.6/dist/sweetalert2.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/vendors/styles/core.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/vendors/styles/icon-font.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/vendors/styles/style.css') }}">
    <style>
        .login-wrap {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f5f5f5;
        }

        .login-box {
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 20px;
            background-color: #fff;
            max-width: 400px;
            width: 100%;
        }

        .input-group.custom {
            flex-direction: column;
            margin-bottom: 1rem;
        }

        .input-group.custom label {
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .input-group.custom .input-group-inner {
            display: flex;
            align-items: stretch;
        }

        .input-group.custom .input-group-text {
            border-radius: 0.25rem 0 0 0.25rem;
            padding: 0.5rem 1rem;
            background-color: #eee;
            border: 1px solid #ccc;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .input-group-text i {
            font-size: 1.2rem;
        }

        .input-group.custom input.form-control {
            border-radius: 0 0.25rem 0.25rem 0;
            border: 1px solid #ccc;
            border-left: none;
            flex: 1;
            padding: 0.5rem 1rem;
        }

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
            align-items: stretch;
        }

        .input-group-inner input {
            padding-right: 40px;
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

<body class="login-page">
    @if (session('status'))
        <div class="alert alert-success text-center">
            {{ session('status') }}
        </div>
    @endif
    <div class="login-wrap">
        <div class="login-box">
            <div class="login-title">
                <h2 class="text-center text-primary">Login</h2>
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-group custom">
                    <label for="email">Email</label>
                    <div class="input-group-inner">
                        <span class="input-group-text"><i class="icon-copy dw dw-email"></i></span>
                        <input type="email" name="email" id="email" class="form-control form-control-lg"
                            placeholder="Masukkan Email" required>
                    </div>
                </div>
                <div class="input-group custom">
                    <label for="password">Password</label>
                    <div class="input-group-inner">
                        <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                        <input type="password" name="password" id="password" class="form-control form-control-lg"
                            placeholder="Masukkan Password" required>
                        <i class="fa fa-eye-slash toggle-password" id="togglePassword"></i>
                    </div>
                </div>
                <div class="row pb-30"></div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="input-group mb-0">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">Login</button>
                        </div>
                        <div class="font-16 weight-600 pt-10 pb-10 text-center" data-color="#707373">
                            Atau
                        </div>
                        <div class="input-group mb-0">
                            <a class="btn btn-outline-primary btn-lg btn-block" href="{{ route('register') }}">
                                Buat Akun
                            </a>
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
    <script>
        const passwordInput = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');
        passwordInput.addEventListener('input', function() {
            togglePassword.style.display = this.value ? 'block' : 'none';
        });
        togglePassword.addEventListener('click', function() {
            const type = passwordInput.type === 'password' ? 'text' : 'password';
            passwordInput.type = type;
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    </script>
    @if (session('register_success'))
        <script>
            Swal.fire({
                title: 'Registrasi Berhasil!',
                text: "{{ session('register_success') }}",
                icon: 'success',
                timer: 3000,
                showConfirmButton: true,
            });
        </script>
    @endif
    @if ($errors->any())
        <script>
            Swal.fire({
                title: 'Login Gagal!',
                html: `{!! implode('<br>', $errors->all()) !!}`,
                icon: 'error',
                timer: 3000,
                showConfirmButton: true,
            });
        </script>
    @endif
    @if (session('login_error'))
        <script>
            Swal.fire({
                title: 'Login Gagal!',
                text: '{{ session('login_error') }}',
                icon: 'error',
                timer: 3000,
                showConfirmButton: true,
            });
        </script>
    @endif
</body>

</html>

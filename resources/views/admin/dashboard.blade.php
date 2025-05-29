@extends('layouts.app')
@section('title', 'Zenith Hotel | Dashboard')
@section('konten')
    <div class="main-container">
        <div class="pd-ltr-20">
            <div class="card-box pd-20 height-100-p mb-30">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        @php
                            $gender = strtolower(Auth::user()->jenis_kelamin);
                            $imagePath =
                                $gender === 'laki-laki'
                                    ? asset('dashboard/asset/banner-pria.png')
                                    : asset('dashboard/asset/banner-wanita.png');
                        @endphp
                        <span class="user-icon">
                            <img src="{{ $imagePath }}" alt="User Avatar">
                        </span>
                    </div>
                    <div class="col-md-8">
                        <h4 class="font-20 weight-500 mb-10 text-capitalize">
                            Selamat Datang {{ Auth::user()->name }} <div class="weight-600 font-30 text-blue">Sebagai
                                Administrator</div>
                        </h4>
                        <p class="font-18 max-width-600">
                            Anda dapat mengelola data kamar hotel, melakukan reservasi, dan mengelola informasi pelanggan
                            melalui dashboard ini. Silakan pilih menu yang sesuai dengan kebutuhan Anda. Jika Anda memiliki
                            pertanyaan atau membutuhkan bantuan, jangan ragu untuk menghubungi kami.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-xl-3 mb-30">
                    <div class="card-box height-100-p widget-style1">
                        <div class="d-flex flex-wrap align-items-center">
                            <div class="progress-data">
                                <i class="fa fa-bed fa-3x text-success"></i>
                            </div>
                            <div class="widget-data pl-3">
                                <div class="h4 mb-0">{{ $jumlahTersedia }}</div>
                                <div class="weight-600 font-14">Tersedia</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 mb-30">
                    <div class="card-box height-100-p widget-style1">
                        <div class="d-flex flex-wrap align-items-center">
                            <div class="progress-data">
                                <i class="fa fa-bed fa-3x text-warning"></i>
                            </div>
                            <div class="widget-data pl-3">
                                <div class="h4 mb-0">{{ $jumlahTerisi }}</div>
                                <div class="weight-600 font-14">Terisi</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 mb-30">
                    <div class="card-box height-100-p widget-style1">
                        <div class="d-flex flex-wrap align-items-center">
                            <div class="progress-data">
                                <i class="fa fa-bed fa-3x text-danger"></i>
                            </div>
                            <div class="widget-data pl-3">
                                <div class="h4 mb-0">{{ $jumlahDiperbaiki }}</div>
                                <div class="weight-600 font-14">Diperbaiki</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 mb-30">
                    <div class="card-box height-100-p widget-style1">
                        <div class="d-flex flex-wrap align-items-center">
                            <div class="progress-data">
                                <i class="dw dw-user2 fa-3x text-primary"></i>
                            </div>
                            <div class="widget-data pl-3">
                                <div class="h4 mb-0">{{ $jumlahUser }}</div>
                                <div class="weight-600 font-14">User</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (session('login_success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                title: 'Login Berhasil!',
                text: "{{ session('login_success') }}",
                icon: "success",
                timer: 3000,
                confirmButtonText: 'OK',
            });
        </script>
    @endif
@endsection

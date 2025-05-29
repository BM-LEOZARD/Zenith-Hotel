@extends('layouts.app')
@section('title', 'Zenith Hotel | Dashboard')
@section('konten')
    <div class="main-container">
        <div class="pd-ltr-20">
            <div class="card-box pd-20 height-100-p mb-30">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        @php
                            $user = Auth::user();
                            $imagePath = '';
                            if ($user->role === 'Customer') {
                                $gender = strtolower($user->jenis_kelamin);
                                $imagePath =
                                    $gender === 'laki-laki'
                                        ? asset('website/asset/banner-pria.png')
                                        : asset('website/asset/banner-wanita.png');
                            }
                        @endphp
                        <span class="user-icon">
                            <img src="{{ $imagePath }}" alt="Banner Pelanggan">
                        </span>
                    </div>
                    <div class="col-md-8">
                        <h4 class="font-20 weight-500 mb-10 text-capitalize">
                            Selamat Datang {{ Auth::user()->name }} <div class="weight-600 font-30 text-blue">Sebagai
                                Pelanggan</div>
                        </h4>
                        <p class="font-18 max-width-600">
                            Anda dapat melakukan reservasi kamar hotel secara online melalui website ini. Silakan pilih
                            kamar yang sesuai dengan kebutuhan Anda dan lakukan reservasi dengan mengisi formulir yang
                            tersedia. Jika Anda memiliki pertanyaan atau membutuhkan bantuan, jangan ragu untuk menghubungi
                            kami.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

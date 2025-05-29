@extends('layouts.app')
@section('title', 'Zenith Hotel | Profile')
@section('konten')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="row justify-content-center">
                    <div class="col-xl-10 col-lg-10 col-md-12">
                        <div class="pd-20 card-box">
                            <div class="row">
                                <div class="col-md-4 text-center">
                                    <div class="profile-photo mb-3">
                                        @php
                                            $user = Auth::user();
                                            $imagePath = '';
                                            if ($user->role === 'Admin') {
                                                $gender = strtolower($user->jenis_kelamin);
                                                $imagePath =
                                                    $gender === 'laki-laki'
                                                        ? asset('dashboard/asset/profile-pria.png')
                                                        : asset('dashboard/asset/profile-wanita.png');
                                            }
                                        @endphp
                                        <img src="{{ $imagePath }}" alt="Avatar" class="avatar-photo"
                                            style="max-width: 100%; height: auto;">
                                    </div>
                                    <h5 class="h5 mb-0">{{ $user->name }}</h5>
                                    <p class="text-muted">{{ $user->username }}</p>
                                </div>
                                <div class="col-md-8">
                                    <h5 class="mb-3 h5 text-blue">Informasi Lengkap</h5>
                                    <div class="container-fluid">
                                        <div class="row mb-4">
                                            <div class="col-md-6">
                                                <strong>Nama Lengkap:</strong><br>
                                                {{ $user->name }}
                                            </div>
                                            <div class="col-md-6">
                                                <strong>Username:</strong><br>
                                                {{ $user->username }}
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-md-6">
                                                <strong>No HP:</strong><br>
                                                {{ $user->no_hp }}
                                            </div>
                                            <div class="col-md-6">
                                                <strong>Email:</strong><br>
                                                {{ $user->email }}
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-md-6">
                                                <strong>Jenis Kelamin:</strong><br>
                                                {{ ucfirst($user->jenis_kelamin) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

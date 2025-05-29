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
                                        <a href="{{ route('customer.profile.edit') }}" class="edit-avatar">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        @php
                                            $user = Auth::user();
                                            $imagePath = '';
                                            if ($user->role === 'Customer') {
                                                $gender = strtolower($user->jenis_kelamin);
                                                $imagePath =
                                                    $gender === 'laki-laki'
                                                        ? asset('website/asset/profile-pria.png')
                                                        : asset('website/asset/profile-wanita.png');
                                            }
                                        @endphp
                                        <img src="{{ $imagePath }}" alt="Avatar" class="avatar-photo"
                                            style="max-width: 100%; height: auto;">
                                    </div>
                                    <h5 class="h5 mb-0">{{ $user->name }}</h5>
                                    <p class="text-muted">{{ $user->username }}</p>
                                    <form id="deleteForm" action="{{ route('customer.profile.destroy') }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" id="deleteButton" class="btn btn-danger mt-3">
                                            <i class="fa fa-trash"></i> Hapus Akun
                                        </button>
                                    </form>
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
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.getElementById('deleteButton').addEventListener('click', function(e) {
                Swal.fire({
                    title: 'Yakin ingin menghapus akun?',
                    text: "Akun Anda akan dinonaktifkan dan tidak bisa digunakan lagi.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('deleteForm').submit();
                    }
                });
            });
        </script>
    </div>
@endsection

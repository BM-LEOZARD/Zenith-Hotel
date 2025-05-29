@extends('layouts.app')
@section('title', 'Zenith Hotel | Profile Edit')
@section('konten')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="row justify-content-center">
                    <div class="col-xl-10 col-lg-10 col-md-12 mb-30">
                        <div class="card-box p-4">
                            <h4 class="text-blue h5 mb-4">Edit Profile</h4>
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            <form method="POST" action="{{ route('customer.profile.update') }}" id="form-update">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{ session()->getOldInput() ? old('name') : $user->name }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input type="text" name="username" class="form-control"
                                                value="{{ session()->getOldInput() ? old('username') : $user->username }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Jenis Kelamin</label>
                                            <select name="jenis_kelamin" class="form-control">
                                                <option value="Laki-laki"
                                                    {{ $user->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                                                </option>
                                                <option value="Perempuan"
                                                    {{ $user->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>No HP</label>
                                            <input type="text" name="no_hp" class="form-control"
                                                value="{{ session()->getOldInput() ? old('no_hp') : $user->no_hp }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" name="email" class="form-control"
                                                value="{{ session()->getOldInput() ? old('email') : $user->email }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Password (biarkan kosong jika tidak ingin mengubah)</label>
                                            <input type="password" name="password" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Konfirmasi Password</label>
                                            <input type="password" name="password_confirmation" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mt-4 text-center d-flex justify-content-center" style="gap: 20px;">
                                    <button type="button" id="btn-update" class="btn btn-primary">Update Profile</button>
                                    <a href="#" id="btn-cancel" class="btn btn-secondary">Kembali</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const form = document.getElementById('form-update');
        const initialFormData = new FormData(form);

        function isFormChanged() {
            const currentFormData = new FormData(form);
            for (let [key, value] of currentFormData.entries()) {
                if (initialFormData.get(key) !== value) {
                    return true;
                }
            }
            return false;
        }
        document.getElementById('btn-update').addEventListener('click', function() {
            Swal.fire({
                title: "Simpan Perubahan?",
                text: "Pastikan semua data sudah benar.",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, simpan!"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Berhasil!",
                        text: "Data profile Anda berhasil diperbarui.",
                        icon: "success",
                        timer: 1500,
                        showConfirmButton: true
                    }).then(() => {
                        form.submit();
                    });
                }
            });
        });
        document.getElementById('btn-cancel').addEventListener('click', function(e) {
            e.preventDefault();
            if (isFormChanged()) {
                Swal.fire({
                    title: "Batalkan Perubahan?",
                    text: "Apakah Anda yakin tidak jadi update profile?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, batalkan!",
                    cancelButtonText: "Lanjutkan Edit"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('customer.profile.index') }}";
                    }
                });
            } else {
                window.location.href = "{{ route('customer.profile.index') }}";
            }
        });
    </script>
@endpush

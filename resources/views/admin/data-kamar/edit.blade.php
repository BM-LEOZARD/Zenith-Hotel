@extends('layouts.app')
@section('title', 'Zenith Hotel | Edit Data Kamar')
@section('konten')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Edit Data Kamar</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="min-height-200px">
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix mb-3">
                        <h4 class="text-blue h4">Data Kamar</h4>
                    </div>
                    <form id="form-update" action="{{ route('admin.data-kamar.update', $kamar->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Nomor Kamar</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="text" name="nomor_kamar"
                                    value="{{ $kamar->nomor_kamar }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Tipe Kamar</label>
                            <div class="col-sm-12 col-md-10">
                                <select class="custom-select col-12" name="tipe_kamar" required>
                                    <option value="Standard" {{ $kamar->tipe_kamar == 'Standard' ? 'selected' : '' }}>
                                        Standard</option>
                                    <option value="Superior" {{ $kamar->tipe_kamar == 'Superior' ? 'selected' : '' }}>
                                        Superior</option>
                                    <option value="Deluxe" {{ $kamar->tipe_kamar == 'Deluxe' ? 'selected' : '' }}>Deluxe
                                    </option>
                                    <option value="Executive" {{ $kamar->tipe_kamar == 'Executive' ? 'selected' : '' }}>
                                        Executive</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Harga per Malam</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="number" name="harga_per_malam"
                                    value="{{ $kamar->harga_per_malam }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Status Kamar</label>
                            <div class="col-sm-12 col-md-10">
                                <select class="custom-select col-12" name="status_kamar" required>
                                    <option value="Tersedia" {{ $kamar->status_kamar == 'Tersedia' ? 'selected' : '' }}>
                                        Tersedia</option>
                                    <option value="Terisi" {{ $kamar->status_kamar == 'Terisi' ? 'selected' : '' }}>Terisi
                                    </option>
                                    <option value="Diperbaiki" {{ $kamar->status_kamar == 'Diperbaiki' ? 'selected' : '' }}>
                                        Diperbaiki</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Gambar Lama</label>
                            <div class="col-sm-12 col-md-10 row">
                                @foreach ($kamar->gambarKamar as $gambar)
                                    <div class="col-md-3 text-center mb-3 posisi-gambar" data-id="{{ $gambar->id }}">
                                        <div class="card">
                                            <img src="{{ asset('storage/' . $gambar->path) }}"
                                                class="card-img-top gambar-thumbnail">
                                            <div class="card-body p-2">
                                                <input type="hidden" name="hapus_gambar[]" value=""
                                                    class="hapus-gambar-input">
                                                <button type="button"
                                                    class="btn btn-danger btn-sm w-100 btn-hapus-gambar">Hapus</button>
                                                <button type="button"
                                                    class="btn btn-warning btn-sm w-100 btn-batalkan-hapus"
                                                    style="display: none;">Batalkan</button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Tambah Gambar Baru</label>
                            <div class="col-sm-12 col-md-10">
                                <div id="gambar-wrapper"></div>
                                <button type="button" class="btn btn-outline-primary btn-sm mt-2" id="tambah-gambar">+
                                    Tambah Gambar</button>
                                <small class="form-text text-muted">Maksimal 5 gambar total (lama + baru).</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Deskripsi Kamar</label>
                            <div class="col-sm-12 col-md-10">
                                <textarea class="form-control" name="deskripsi_kamar" rows="4" required>{{ $kamar->deskripsi_kamar }}</textarea>
                            </div>
                        </div>
                        <div class="form-group mt-4 text-center d-flex justify-content-center" style="gap: 20px;">
                            <button type="button" id="btn-update" class="btn btn-primary">Simpan</button>
                            <button type="button" id="btn-cancel" class="btn btn-secondary">Kembali</button>
                        </div>
                    </form>
                    <div class="modal fade" id="modalPreviewGambar" tabindex="-1" role="dialog"
                        aria-labelledby="previewLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-body text-center">
                                    <img src="" id="previewGambar" class="img-fluid rounded">
                                </div>
                            </div>
                        </div>
                    </div>
                    @push('scripts')
                        <style>
                            .gambar-thumbnail {
                                height: 150px;
                                object-fit: cover;
                                width: 100%;
                                border-radius: 5px;
                            }

                            .posisi-gambar .card {
                                height: 100%;
                                display: flex;
                                flex-direction: column;
                                justify-content: space-between;
                            }

                            .posisi-gambar .btn-hapus-gambar {
                                margin-top: 5px;
                            }
                        </style>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const wrapper = document.getElementById('gambar-wrapper');
                                const tambahBtn = document.getElementById('tambah-gambar');
                                tambahBtn.addEventListener('click', function() {
                                    const jumlahLama = document.querySelectorAll('.posisi-gambar .hapus-gambar-input[value=""]')
                                        .length;
                                    const jumlahBaru = wrapper.querySelectorAll('input[type="file"]').length;
                                    const total = jumlahLama + jumlahBaru;
                                    if (total >= 5) return alert("Total gambar maksimal 5");
                                    const inputGroup = document.createElement('div');
                                    inputGroup.className = 'input-group mb-2';
                                    inputGroup.innerHTML = `
                                        <div class="custom-file">
                                            <input type="file" name="gambar[]" class="custom-file-input" required>
                                            <label class="custom-file-label">Pilih file</label>
                                        </div>
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-danger btn-sm remove-image">&times;</button>
                                        </div>
                                    `;
                                    wrapper.appendChild(inputGroup);
                                    inputGroup.querySelector('.remove-image').addEventListener('click', function() {
                                        inputGroup.remove();
                                    });
                                    inputGroup.querySelector('input').addEventListener('change', function(e) {
                                        const label = e.target.nextElementSibling;
                                        if (e.target.files[0]) label.innerText = e.target.files[0].name;
                                    });
                                });
                                document.querySelectorAll('.btn-hapus-gambar').forEach(button => {
                                    button.addEventListener('click', function() {
                                        const container = this.closest('.posisi-gambar');
                                        const input = container.querySelector('.hapus-gambar-input');
                                        input.value = container.dataset.id;
                                        container.style.opacity = 0.5;
                                        container.querySelector('img').style.filter = "grayscale(100%)";
                                        this.style.display = "none";
                                        container.querySelector('.btn-batalkan-hapus').style.display = "inline-block";
                                    });
                                });
                                document.querySelectorAll('.btn-batalkan-hapus').forEach(button => {
                                    button.addEventListener('click', function() {
                                        const container = this.closest('.posisi-gambar');
                                        const input = container.querySelector('.hapus-gambar-input');
                                        input.value = '';
                                        container.style.opacity = 1;
                                        container.querySelector('img').style.filter = "none";
                                        this.style.display = "none";
                                        container.querySelector('.btn-hapus-gambar').style.display = "inline-block";
                                    });
                                });
                                document.querySelectorAll('.gambar-thumbnail').forEach(img => {
                                    img.addEventListener('click', function() {
                                        const modalImg = document.getElementById('previewGambar');
                                        modalImg.src = this.src;
                                        $('#modalPreviewGambar').modal('show');
                                    });
                                });
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
                                                title: "Menyimpan...",
                                                text: "Silakan tunggu sebentar.",
                                                allowOutsideClick: false,
                                                allowEscapeKey: false,
                                                didOpen: () => {
                                                    Swal.showLoading();
                                                }
                                            });
                                            setTimeout(() => {
                                                form.submit();
                                            }, 1500);
                                        }
                                    });
                                });
                                document.getElementById('btn-cancel').addEventListener('click', function(e) {
                                    e.preventDefault();
                                    if (isFormChanged()) {
                                        Swal.fire({
                                            title: "Batalkan Perubahan?",
                                            text: "Apakah Anda yakin tidak jadi mengubah data kamar?",
                                            icon: "warning",
                                            showCancelButton: true,
                                            confirmButtonColor: "#3085d6",
                                            cancelButtonColor: "#d33",
                                            confirmButtonText: "Ya, batalkan!",
                                            cancelButtonText: "Lanjutkan Edit"
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                window.location.href = "{{ route('admin.data-kamar.index') }}";
                                            }
                                        });
                                    } else {
                                        window.location.href = "{{ route('admin.data-kamar.index') }}";
                                    }
                                });
                            });
                            @if (session('success'))
                                Swal.fire({
                                    title: "{{ session('success') }}",
                                    icon: "success",
                                    timer: 2000,
                                    showConfirmButton: false
                                });
                            @endif
                        </script>
                    @endpush
                </div>
            </div>
        </div>
    </div>
@endsection

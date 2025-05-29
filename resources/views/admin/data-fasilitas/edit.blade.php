@extends('layouts.app')
@section('title', 'Zenith Hotel | Edit Data Fasilitas')
@section('konten')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="title">
                                <h4>Edit Data Fasilitas</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix mb-3">
                        <h4 class="text-blue h4">Data Fasilitas</h4>
                    </div>
                    <form id="form-update" action="{{ route('admin.data-fasilitas.update', $fasilitas->id) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Nama Fasilitas</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="text" name="nama_fasilitas"
                                    value="{{ $fasilitas->nama_fasilitas }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Deskripsi Fasilitas</label>
                            <div class="col-sm-12 col-md-10">
                                <textarea class="form-control" name="deskripsi_fasilitas" rows="4" required>{{ $fasilitas->deskripsi_fasilitas }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Gambar Lama</label>
                            <div class="col-sm-12 col-md-10 row">
                                @foreach ($fasilitas->gambarFasilitas as $gambar)
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
                                        input.value = "";
                                        container.style.opacity = 1;
                                        container.querySelector('img').style.filter = "none";
                                        container.querySelector('.btn-hapus-gambar').style.display = "inline-block";
                                        this.style.display = "none";
                                    });
                                });
                            });
                        </script>
                        <script>
                            document.querySelectorAll('.gambar-thumbnail').forEach(img => {
                                img.style.cursor = 'zoom-in';
                                img.addEventListener('click', function() {
                                    const modalImg = document.getElementById('previewGambar');
                                    modalImg.src = this.src;
                                    $('#modalPreviewGambar').modal('show');
                                });
                            });
                        </script>
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const form = document.getElementById('form-update');
                                const btnUpdate = document.getElementById('btn-update');
                                const btnCancel = document.getElementById('btn-cancel');
                                const originalData = new FormData(form);
                                btnUpdate.addEventListener('click', function() {
                                    Swal.fire({
                                        title: 'Apakah Anda yakin?',
                                        text: "Perubahan data fasilitas akan disimpan.",
                                        icon: 'question',
                                        showCancelButton: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Ya, Simpan!',
                                        cancelButtonText: 'Batal'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            Swal.fire({
                                                title: 'Menyimpan...',
                                                text: 'Mohon tunggu sebentar',
                                                allowOutsideClick: false,
                                                didOpen: () => {
                                                    Swal.showLoading();
                                                    form.submit();
                                                }
                                            });
                                        }
                                    });
                                });
                                btnCancel.addEventListener('click', function(e) {
                                    e.preventDefault();
                                    const currentData = new FormData(form);
                                    let changed = false;
                                    for (let [key, value] of currentData.entries()) {
                                        if (originalData.get(key) !== value) {
                                            changed = true;
                                            break;
                                        }
                                    }
                                    if (changed) {
                                        Swal.fire({
                                            title: "Batalkan Perubahan?",
                                            text: "Data yang sudah diubah akan hilang jika tidak disimpan.",
                                            icon: "warning",
                                            showCancelButton: true,
                                            confirmButtonColor: "#3085d6",
                                            cancelButtonColor: "#d33",
                                            confirmButtonText: "Ya, batalkan!",
                                            cancelButtonText: "Lanjutkan Edit"
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                window.location.href = "{{ route('admin.data-fasilitas.index') }}";
                                            }
                                        });
                                    } else {
                                        window.location.href = "{{ route('admin.data-fasilitas.index') }}";
                                    }
                                });
                            });
                        </script>
                    @endpush
                </div>
            </div>
        </div>
    </div>
@endsection

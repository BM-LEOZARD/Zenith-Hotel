@extends('layouts.app')
@section('title', 'Zenith Hotel | Tambah Data Fasilitas')
@section('konten')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="title">
                                <h4>Tambah Data Fasilitas</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-blue h4">Form Data Fasilitas</h4>
                            <p class="mb-30"></p>
                        </div>
                    </div>
                    <form id="form-tambah-fasilitas" action="{{ route('admin.data-fasilitas.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Nama Fasilitas</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="text" name="nama_fasilitas"
                                    placeholder="Contoh: Kolam Renang" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Deskripsi Fasilitas</label>
                            <div class="col-sm-12 col-md-10">
                                <textarea class="form-control" name="deskripsi_fasilitas" rows="4" placeholder="Deskripsikan fasilitas ini..."
                                    required></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Gambar</label>
                            <div class="col-sm-12 col-md-10">
                                <div id="gambar-wrapper">
                                    <div class="input-group mb-2">
                                        <div class="custom-file">
                                            <input type="file" name="gambar[]" class="custom-file-input" required>
                                            <label class="custom-file-label">Pilih file</label>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-outline-primary btn-sm mt-2" id="tambah-gambar">+
                                    Tambah Gambar</button>
                                <small class="form-text text-muted">Maksimal 5 gambar.</small>
                            </div>
                        </div>
                        <div class="form-group mt-4 text-center d-flex justify-content-center" style="gap: 20px;">
                            <button type="button" class="btn btn-primary" id="btn-submit">Tambah Fasilitas</button>
                            <a href="{{ route('admin.data-fasilitas.index') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                    @push('scripts')
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                document.getElementById('btn-submit').addEventListener('click', function() {
                                    Swal.fire({
                                        title: 'Apakah Anda yakin?',
                                        text: "Data fasilitas akan disimpan.",
                                        icon: 'question',
                                        showCancelButton: true,
                                        confirmButtonText: 'Ya, simpan',
                                        cancelButtonText: 'Batal',
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            Swal.fire({
                                                title: 'Menyimpan...',
                                                text: 'Silakan tunggu sebentar.',
                                                allowOutsideClick: false,
                                                allowEscapeKey: false,
                                                didOpen: () => {
                                                    Swal.showLoading();
                                                }
                                            });
                                            setTimeout(() => {
                                                document.getElementById('form-tambah-fasilitas').submit();
                                            }, 1500);
                                        }
                                    });
                                });

                                function updateFileName(input) {
                                    const label = input.nextElementSibling;
                                    if (input.files[0]) label.innerText = input.files[0].name;
                                }
                                const wrapper = document.getElementById('gambar-wrapper');
                                const tambahBtn = document.getElementById('tambah-gambar');
                                tambahBtn.addEventListener('click', function() {
                                    const totalInputs = wrapper.querySelectorAll('input[type="file"]').length;
                                    if (totalInputs >= 5) return alert("Maksimal hanya 5 gambar");
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
                                    const newInput = inputGroup.querySelector('input');
                                    newInput.addEventListener('change', function(e) {
                                        updateFileName(newInput);
                                    });
                                    inputGroup.querySelector('.remove-image').addEventListener('click', function() {
                                        inputGroup.remove();
                                    });
                                });
                                const firstInput = wrapper.querySelector('input[type="file"]');
                                firstInput.addEventListener('change', function() {
                                    updateFileName(firstInput);
                                });
                            });
                        </script>
                    @endpush
                </div>
            </div>
        </div>
    </div>
@endsection

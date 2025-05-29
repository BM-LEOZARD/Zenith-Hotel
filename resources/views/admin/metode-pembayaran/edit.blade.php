@extends('layouts.app')
@section('title', 'Zenith Hotel | Edit Metode Pembayaran')
@section('konten')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="title">
                                <h4>Edit Data Metode Pembayaran</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix mb-3">
                        <h4 class="text-blue h4">Data Metode Pembayaran</h4>
                    </div>
                    <form id="form-update" action="{{ route('admin.metode-pembayaran.update', $metodePembayaran->id) }}"
                        method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Metode Pembayaran</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="text" name="metode_pembayaran"
                                    value="{{ $metodePembayaran->metode_pembayaran }}" required>
                            </div>
                        </div>
                        <div class="form-group mt-4 text-center d-flex justify-content-center" style="gap: 20px;">
                            <button type="button" id="btn-update" class="btn btn-primary">Simpan</button>
                            <button type="button" id="btn-cancel" class="btn btn-secondary">Kembali</button>
                        </div>
                    </form>
                    @push('scripts')
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
                                                window.location.href = "{{ route('admin.metode-pembayaran.index') }}";
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

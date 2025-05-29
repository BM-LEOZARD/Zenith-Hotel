@extends('layouts.app')
@section('title', 'Zenith Hotel | Tambah Metode Pembayaran')
@section('konten')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="title">
                                <h4>Tambah Metode Pembayaran</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-blue h4">Form Metode Pembayaran</h4>
                        </div>
                    </div>
                    <form id="form-tambah-metode-pembayaran" action="{{ route('admin.metode-pembayaran.store') }}"
                        method="POST">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Metode Pembayaran</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="text" name="metode_pembayaran"
                                    placeholder="Contoh: BRI" required>
                            </div>
                        </div>
                        <div class="form-group mt-4 text-center d-flex justify-content-center" style="gap: 20px;">
                            <button type="button" class="btn btn-primary" id="btn-submit">Tambah Pembayaran</button>
                            <a href="{{ route('admin.metode-pembayaran.index') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('btn-submit').addEventListener('click', function() {
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Metode Pembayaran akan disimpan.",
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
                            text: 'Mohon tunggu sebentar.',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                        setTimeout(() => {
                            document.getElementById('form-tambah-metode-pembayaran')
                                .submit();
                        }, 1500);
                    }
                });
            });
        });
    </script>
@endpush

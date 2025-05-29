@extends('layouts.app')
@section('title', 'Zenith Hotel | Detail Kamar')
@section('konten')
    <div class="main-container">
        <div class="pd-ltr-20">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Detail Data Kamar</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h4 class="text-blue h4">Data Kamar</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Nomor Kamar:</h5>
                            <p>{{ $kamar->nomor_kamar }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Tipe Kamar:</h5>
                            <p>{{ $kamar->tipe_kamar }}</p>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Harga per Malam:</h5>
                            <p>Rp{{ number_format($kamar->harga_per_malam, 0, ',', '.') }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Status Kamar:</h5>
                            <p>{{ $kamar->status_kamar }}</p>
                        </div>
                    </div>
                    <div class="mb-4">
                        <h5>Deskripsi:</h5>
                        <p style="white-space: pre-wrap;">{{ $kamar->deskripsi_kamar }}</p>
                    </div>
                    <div class="mb-4">
                        <h5>Gambar Kamar:</h5>
                        <div class="row" style="background-color: #f8f9fa; padding: 10px; border-radius: 8px;">
                            @forelse ($kamar->gambarKamar as $gambar)
                                <div class="col-6 col-sm-4 col-md-3 mb-3 d-flex justify-content-center">
                                    <img src="{{ asset('storage/' . $gambar->path) }}"
                                        onclick="showImageModal('{{ asset('storage/' . $gambar->path) }}')"
                                        class="img-thumbnail"
                                        style="width: 100%; max-width: 250px; height: 160px; object-fit: cover; border-radius: 8px; box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1); cursor: pointer;"
                                        alt="Gambar kamar">
                                </div>
                            @empty
                                <p class="text-muted">Tidak ada gambar tersedia.</p>
                            @endforelse
                        </div>
                    </div>
                    <div class="form-group mt-4 text-center d-flex justify-content-center" style="gap: 20px;">
                        <a href="{{ route('admin.data-kamar.index') }}" class="btn btn-secondary mt-3">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<div class="modal fade" id="gambarModal" tabindex="-1" role="dialog" aria-labelledby="gambarModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <img id="modalGambar" src="" class="img-fluid rounded" alt="Preview Gambar">
        </div>
    </div>
</div>
<script>
    function showImageModal(imageSrc) {
        document.getElementById('modalGambar').src = imageSrc;
        $('#gambarModal').modal('show');
    }
</script>

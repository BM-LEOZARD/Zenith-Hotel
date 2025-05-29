@extends('layouts.guest')
@section('title', 'Zenith Hotel | Detail Reservasi Kamar')
@section('konten')
    <style>
        .kamar_img {
            width: 100%;
            height: 400px;
            overflow: hidden;
            border-radius: 12px;
            position: relative;
            background-color: #f0f0f0;
        }

        .kamar_img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .kamar_info {
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 24px;
            min-height: 200px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .kamar_deskripsi {
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 24px;
            background-color: #f8f9fa;
        }
    </style>
    <section class="breadcrumb_area">
        <div class="overlay bg-parallax"></div>
        <div class="container">
            <div class="page-cover text-center">
                <h2 class="page-cover-tittle">Detail Reservasi</h2>
            </div>
        </div>
    </section>
    <div class="container my-3">
        <div class="row">
            <div class="col-12 text-center">
                <a href="{{ url('/reservasi') }}" class="btn btn-secondary">← Kembali ke Daftar Kamar</a>
            </div>
        </div>
    </div>
    <div class="container my-5">
        <div class="row g-4">
            <div class="col-md-6">
                @if ($kamar->gambarKamar->count() > 0)
                    <div id="carouselKamar" class="carousel slide shadow-lg rounded" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            @foreach ($kamar->gambarKamar as $index => $gambar)
                                <button type="button" data-bs-target="#carouselKamar"
                                    data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"
                                    aria-current="{{ $index == 0 ? 'true' : 'false' }}"
                                    aria-label="Slide {{ $index + 1 }}"></button>
                            @endforeach
                        </div>
                        <div class="carousel-inner">
                            @foreach ($kamar->gambarKamar as $index => $gambar)
                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                    <div class="kamar_img">
                                        <img src="{{ asset('storage/' . $gambar->path) }}" alt="Gambar Kamar">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @if ($kamar->gambarKamar->count() > 1)
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselKamar"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                                <span class="visually-hidden">Sebelumnya</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselKamar"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon"></span>
                                <span class="visually-hidden">Berikutnya</span>
                            </button>
                        @endif
                    </div>
                @else
                    <div class="kamar_img">
                        <img src="{{ asset('website/image/no-image.png') }}" alt="No Image">
                    </div>
                @endif
            </div>
            <div class="col-md-6">
                <div class="kamar_info">
                    <h4 class="fw-bold mb-4">Informasi Kamar</h4>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bi bi-door-closed-fill me-2 text-primary"></i> <strong>Nomor
                                Kamar:</strong> {{ $kamar->nomor_kamar ?? '-' }}</li>
                        <li class="mb-2"><i class="bi bi-house-door-fill me-2 text-primary"></i> <strong>Tipe
                                Kamar:</strong> {{ $kamar->tipe_kamar ?? '-' }}</li>
                        <li class="mb-2"><i class="bi bi-cash-coin me-2 text-primary"></i> <strong>Harga:</strong>
                            Rp{{ number_format($kamar->harga_per_malam, 0, ',', '.') }}/malam</li>
                    </ul>
                    @if ($kamar->status_kamar !== 'Diperbaiki')
                        <a href="{{ url('/buat-reservasi/' . $kamar->id) }}" class="btn btn-success mt-4 w-100">
                            <i class="bi bi-calendar-check me-1"></i> Booking Sekarang
                        </a>
                    @else
                        <div class="alert alert-warning mt-4 text-center">
                            <i class="bi bi-exclamation-triangle-fill"></i> Kamar sedang dalam perbaikan
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="kamar_deskripsi">
                    <h5 class="fw-semibold"><i class="bi bi-card-text me-2 text-primary"></i> Deskripsi Kamar</h5>
                    <p class="mt-2">{{ $kamar->deskripsi_kamar }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
@endpush
@push('script')
@endpush

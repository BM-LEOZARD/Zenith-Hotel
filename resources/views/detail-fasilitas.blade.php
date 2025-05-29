@extends('layouts.guest')
@section('title', 'Zenith Hotel | Detail Fasilitas')
@section('konten')
    <style>
        .fasilitas_img {
            width: 100%;
            height: 400px;
            overflow: hidden;
            border-radius: 12px;
            position: relative;
        }

        .fasilitas_img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .fasilitas_info {
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 24px;
            min-height: 200px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .fasilitas_deskripsi {
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
                <h2 class="page-cover-tittle">Detail Fasilitas</h2>
            </div>
        </div>
    </section>
    <div class="container my-3">
        <div class="row">
            <div class="col-12 text-center">
                <a href="{{ route('fasilitas') }}" class="btn btn-secondary">← Kembali ke Halaman Fasilitas</a>
            </div>
        </div>
    </div>
    <div class="container my-5">
        <div class="row g-4">
            <div class="col-md-6">
                @if ($fasilitas->gambarFasilitas->count() > 0)
                    <div id="carouselFasilitas" class="carousel slide shadow-lg rounded" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            @foreach ($fasilitas->gambarFasilitas as $index => $gambar)
                                <button type="button" data-bs-target="#carouselFasilitas"
                                    data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"
                                    aria-current="{{ $index == 0 ? 'true' : 'false' }}"
                                    aria-label="Slide {{ $index + 1 }}"></button>
                            @endforeach
                        </div>
                        <div class="carousel-inner">
                            @foreach ($fasilitas->gambarFasilitas as $index => $gambar)
                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                    <div class="fasilitas_img">
                                        <img src="{{ asset('storage/' . $gambar->path) }}" alt="Gambar Fasilitas">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @if ($fasilitas->gambarFasilitas->count() > 1)
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselFasilitas"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                                <span class="visually-hidden">Sebelumnya</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselFasilitas"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon"></span>
                                <span class="visually-hidden">Berikutnya</span>
                            </button>
                        @endif
                    </div>
                @else
                    <div class="fasilitas_img">
                        <img src="{{ asset('website/image/no-image.png') }}" alt="No Image">
                    </div>
                @endif
            </div>
            <div class="col-md-6">
                <div class="fasilitas_info">
                    <h4 class="fw-bold mb-4">Informasi Fasilitas</h4>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bi bi-gear-fill me-2 text-primary"></i>
                            <strong>Nama Fasilitas:</strong> {{ $fasilitas->nama_fasilitas }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="fasilitas_deskripsi">
                    <h5 class="fw-semibold"><i class="bi bi-card-text me-2 text-primary"></i> Deskripsi Fasilitas</h5>
                    <p class="mt-2">{{ $fasilitas->deskripsi_fasilitas }}</p>
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

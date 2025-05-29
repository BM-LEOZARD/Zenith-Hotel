@extends('layouts.guest')
@section('title', 'Zenith Hotel | Fasilitas')
@section('konten')
    <style>
        .hotel_img {
            width: 100%;
            height: 200px;
            overflow: hidden;
            border-radius: 8px;
            position: relative;
        }

        .hotel_img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .hotel_img .theme_btn {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            padding: 5px 15px;
        }

        .pagination {
            flex-wrap: wrap;
            justify-content: center;
            gap: 5px;
        }

        .pagination .page-item {
            margin: 0 2px;
        }

        .pagination .page-link {
            padding: 0.5rem 0.75rem;
            border-radius: 6px;
            transition: all 0.2s ease-in-out;
        }

        .pagination .page-item.active .page-link {
            background-color: #f3c300;
            border-color: #f3c300;
            color: white;
        }

        .pagination .page-link:hover {
            background-color: #e0e0e0;
        }
    </style>
    <section class="breadcrumb_area">
        <div class="overlay bg-parallax"></div>
        <div class="container">
            <div class="page-cover text-center">
                <h2 class="page-cover-tittle">Fasilitas</h2>
            </div>
        </div>
    </section>
    <section class="accomodation_area section_gap">
        <div class="container">
            <div class="section_title text-center">
                <h2 class="title_color">Fasilitas Unggulan</h2>
                <p>Berikut adalah beberapa fasilitas yang kami sediakan untuk kenyamanan Anda.</p>
            </div>
            <div class="row accomodation_two mt-4">
                @forelse ($fasilitas as $item)
                    <div class="col-lg-3 col-sm-6 mb-4">
                        <div class="accomodation_item text-center">
                            <div class="hotel_img">
                                @if ($item->gambarFasilitas->first())
                                    <img src="{{ asset('storage/' . $item->gambarFasilitas->first()->path) }}"
                                        alt="Gambar fasilitas">
                                @else
                                    <img src="{{ asset('website/image/no-image.png') }}" alt="No Image">
                                @endif
                                <a href="{{ route('fasilitas.show', $item->id) }}"
                                    class="btn theme_btn button_hover">Detail</a>
                            </div>
                            <a href="#">
                                <h4 class="sec_h4 mt-3">{{ $item->nama_fasilitas }}</h4>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center mt-4">
                        <p>Tidak ada fasilitas yang tersedia untuk saat ini.</p>
                    </div>
                @endforelse
            </div>
            @if ($fasilitas->hasPages())
                <div class="row">
                    <div class="col-12 d-flex justify-content-center mt-4">
                        {{ $fasilitas->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection

@extends('layouts.guest')
@section('title', 'Zenith Hotel | Reservasi Kamar')
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
                <h2 class="page-cover-tittle">Reservasi Kamar</h2>
            </div>
        </div>
    </section>
    <section class="accomodation_area section_gap">
        <div class="container">
            <div class="section_title text-center">
                <h2 class="title_color">Cari Kamar Tersedia</h2>
                <p>Gunakan filter di bawah ini untuk mencari kamar</p>
            </div>
            <div class="hotel_booking_area position mb-5">
                <div class="container">
                    <div class="hotel_booking_table d-flex align-items-center justify-content-center">
                        <form action="{{ route('guest.cari.kamar') }}" method="GET" class="row w-100">
                            <div class="col-md-3">
                                <h2>Cari<br> Kamar</h2>
                            </div>
                            <div class="col-md-9">
                                <div class="boking_table">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="book_tabel_item">
                                                <div class="form-group">
                                                    <input type="date" name="tanggal_check_in" class="form-control"
                                                        value="{{ request('tanggal_check_in') }}">
                                                </div>
                                                <div class="form-group">
                                                    <input type="date" name="tanggal_check_out" class="form-control"
                                                        value="{{ request('tanggal_check_out') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="book_tabel_item">
                                                <div class="input-group mb-3">
                                                    <select name="tipe_kamar" class="form-control">
                                                        <option value="">-- Semua Tipe --</option>
                                                        <option value="Standard"
                                                            {{ request('tipe_kamar') == 'Standard' ? 'selected' : '' }}>
                                                            Standard</option>
                                                        <option value="Superior"
                                                            {{ request('tipe_kamar') == 'Superior' ? 'selected' : '' }}>
                                                            Superior</option>
                                                        <option value="Deluxe"
                                                            {{ request('tipe_kamar') == 'Deluxe' ? 'selected' : '' }}>Deluxe
                                                        </option>
                                                        <option value="Executive"
                                                            {{ request('tipe_kamar') == 'Executive' ? 'selected' : '' }}>
                                                            Executive</option>
                                                    </select>
                                                </div>
                                                <div class="input-group">
                                                    <input type="number" name="harga_min" class="form-control"
                                                        placeholder="Harga Min" value="{{ request('harga_min') }}">
                                                    <input type="number" name="harga_max" class="form-control ms-2"
                                                        placeholder="Harga Max" value="{{ request('harga_max') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="book_tabel_item text-center">
                                                <button type="submit" class="book_now_btn button_hover mb-2 w-100">Cari
                                                    Kamar</button>
                                                <a href="{{ url('/reservasi') }}" class="btn btn-danger w-100">❌ Batalkan
                                                    Filter</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row accomodation_two mt-4">
                @forelse ($kamar as $item)
                    <div class="col-lg-3 col-sm-6 mb-4">
                        <div class="accomodation_item text-center">
                            <div class="hotel_img">
                                <img src="{{ asset('storage/' . $item->gambarKamar->first()->path) }}" alt="Gambar kamar">
                                <a href="{{ url('/detail-reservasi/' . $item->id) }}"
                                    class="btn theme_btn button_hover">Detail</a>
                            </div>
                            <a href="#">
                                <h4 class="sec_h4 mt-3">{{ $item->tipe_kamar }}</h4>
                            </a>
                            <h5>Rp{{ number_format($item->harga_per_malam, 0, ',', '.') }}<small>/malam</small></h5>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center mt-4">
                        <p>Tidak ada kamar yang tersedia untuk saat ini.</p>
                    </div>
                @endforelse
            </div>
            @if ($kamar->hasPages())
                <div class="row">
                    <div class="col-12 d-flex justify-content-center mt-4">
                        {{ $kamar->withQueryString()->onEachSide(1)->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection

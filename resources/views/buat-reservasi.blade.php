@extends('layouts.guest')
@section('title', 'Zenith Hotel | Buat Reservasi Kamar')
@section('konten')
    <section class="breadcrumb_area">
        <div class="overlay bg-parallax" data-stellar-ratio="0.8" data-stellar-vertical-offset="0" data-background=""></div>
        <div class="container">
            <div class="page-cover text-center">
                <h2 class="page-cover-tittle">Buat Reservasi</h2>
            </div>
        </div>
    </section>
    <div class="container py-5">
        <h2>Reservasi Kamar: {{ $kamar->tipe_kamar }}</h2>
        @if ($errors->any())
            <div class="alert alert-danger mt-3">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('guest.reservasi.store') }}" method="POST" class="mt-4">
            @csrf
            <input type="hidden" name="data_kamar_id" value="{{ $kamar->id }}">
            <input type="hidden" name="tipe_kamar" value="{{ $kamar->tipe_kamar }}">
            <div class="form-group mb-3">
                <label for="nama_customer">Nama Customer</label>
                <input type="text" name="nama_customer" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label for="tanggal_check_in">Tanggal Check-In</label>
                <input type="date" name="tanggal_check_in" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label for="tanggal_check_out">Tanggal Check-Out</label>
                <input type="date" name="tanggal_check_out" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label for="jumlah_tamu">Jumlah Tamu</label>
                <input type="number" name="jumlah_tamu" class="form-control" min="1" max="4" required>
            </div>
            <div class="form-group mb-3">
                <label for="metode_pembayaran">Metode Pembayaran</label>
                <select name="metode_pembayaran" class="form-control" required>
                    <option value="">-- Pilih Metode Pembayaran --</option>
                    @foreach ($metodePembayaran as $metode)
                        <option value="{{ $metode->metode_pembayaran }}">{{ $metode->metode_pembayaran }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="no_rekening">Nomor Rekening</label>
                <input type="number" name="no_rekening" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary mt-4">Kirim Reservasi</button>
        </form>
    </div>
@endsection

@extends('layouts.app')
@section('title', 'Zenith Hotel | Detail Reservasi')
@php
    use Carbon\Carbon;
    $checkIn = Carbon::parse($reservasi->tanggal_check_in);
    $checkOut = Carbon::parse($reservasi->tanggal_check_out);
    $durasi = $checkIn->diffInDays($checkOut);
    $hargaPerMalam = $reservasi->dataKamar->harga_per_malam;
    $totalHarga = $durasi > 0 ? $hargaPerMalam * $durasi : $hargaPerMalam;
@endphp
@section('konten')
    <div class="main-container">
        <div class="pd-ltr-20">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Detail Reservasi</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h4 class="text-blue h4">Data Reservasi</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Nama Customer:</h5>
                            <p>{{ $reservasi->nama_customer }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Nomor Kamar:</h5>
                            <p>{{ $reservasi->dataKamar->nomor_kamar }}</p>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Tanggal Check-in:</h5>
                            <p>{{ $checkIn->translatedFormat('d F Y') }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Tanggal Check-out:</h5>
                            <p>{{ $checkOut->translatedFormat('d F Y') }}</p>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Jumlah Tamu:</h5>
                            <p>{{ $reservasi->jumlah_tamu }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Tipe Kamar:</h5>
                            <p>{{ $reservasi->dataKamar->tipe_kamar }}</p>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Metode Pembayaran:</h5>
                            <p>{{ $reservasi->metode_pembayaran }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Harga per Malam:</h5>
                            <p>Rp {{ number_format($reservasi->harga, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Durasi Menginap:</h5>
                            <p>{{ $durasi }} malam</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Total Harga:</h5>
                            <p>Rp {{ number_format($reservasi->total_harga, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Status Pembayaran:</h5>
                            <p>{{ $reservasi->status_pembayaran }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Status Pemesanan:</h5>
                            <p>{{ $reservasi->status_pemesanan }}</p>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Nomor Rekening:</h5>
                            <p>{{ $reservasi->no_rekening }}</p>
                        </div>
                    </div>
                    <div class="form-group mt-4 text-center d-flex justify-content-center" style="gap: 20px;">
                        <a href="{{ route('admin.data-reservasi.index') }}" class="btn btn-secondary mt-3">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

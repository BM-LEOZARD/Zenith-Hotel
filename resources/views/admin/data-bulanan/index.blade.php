@extends('layouts.app')
@section('title', 'Zenith Hotel | Data Bulanan')
@section('konten')
    <div class="main-container">
        <form method="GET" action="{{ route('admin.data-bulanan.index') }}" class="mb-3">
            <div class="row align-items-end">
                <div class="col-md-3">
                    <label for="bulan">Bulan</label>
                    <select name="bulan" id="bulan" class="form-control">
                        <option value="">-- Pilih Bulan --</option>
                        @foreach (range(1, 12) as $bln)
                            <option value="{{ $bln }}" {{ request('bulan') == $bln ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::create()->month($bln)->translatedFormat('F') }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="tahun">Tahun</label>
                    <select name="tahun" id="tahun" class="form-control">
                        <option value="">-- Pilih Tahun --</option>
                        @for ($year = now()->year; $year >= 2020; $year--)
                            <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Tampilkan</button>
                </div>
                @if (request('bulan') || request('tahun'))
                    <div class="col-md-2">
                        <a href="{{ route('admin.data-bulanan.index') }}" class="btn btn-danger">Reset Filter</a>
                    </div>
                @endif
            </div>
        </form>
        <div class="pd-ltr-20">
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h4 class="text-blue h4">
                        Laporan Bulanan -
                        @if (request('bulan') && request('tahun'))
                            {{ \Carbon\Carbon::createFromDate(request('tahun'), request('bulan'), 1)->translatedFormat('F Y') }}
                        @else
                            Semua Bulan
                        @endif
                    </h4>
                </div>
                <div class="pb-20">
                    <div class="table-responsive">
                        <table class="table hover multiple-select-row data-table-export nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Customer</th>
                                    <th>No Kamar</th>
                                    <th>Tipe Kamar</th>
                                    <th>Tgl Check In</th>
                                    <th>Tgl Check Out</th>
                                    <th>Jumlah Tamu</th>
                                    <th>Metode Pembayaran</th>
                                    <th>Nomor Rekening</th>
                                    <th>Total Harga</th>
                                    <th>Status Pemesanan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($reservasi as $index => $r)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $r->nama_customer }}</td>
                                        <td>{{ $r->dataKamar->nomor_kamar ?? '-' }}</td>
                                        <td>{{ $r->tipe_kamar }}</td>
                                        <td>{{ \Carbon\Carbon::parse($r->tanggal_check_in)->format('d-m-Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($r->tanggal_check_out)->format('d-m-Y') }}</td>
                                        <td>{{ $r->jumlah_tamu }}</td>
                                        <td>{{ $r->metode_pembayaran }}</td>
                                        <td>{{ $r->no_rekening }}</td>
                                        <td>Rp{{ number_format($r->total_harga, 0, ',', '.') }}</td>
                                        <td>{{ $r->status_pemesanan }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="11">
                                            <div class="alert alert-danger text-center m-0">
                                                Data Bulanan tidak ditemukan.
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

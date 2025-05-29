@extends('layouts.app')
@section('title', 'Zenith Hotel | Histori Reservasi Saya')
@section('konten')
    <div class="main-container">
        <div class="pd-ltr-20">
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h4 class="text-blue h4">Histori Reservasi Saya</h4>
                </div>
                <div class="pb-20">
                    <table class="data-table table stripe hover nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Nomor Kamar</th>
                                <th>Status Pembayaran</th>
                                <th>Status Pemesanan</th>
                                <th class="datatable-nosort">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($histori as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->nama_customer }}</td>
                                    <td>{{ $item->dataKamar->nomor_kamar ?? '-' }}</td>
                                    <td>{{ $item->status_pembayaran }}</td>
                                    <td>{{ $item->status_pemesanan }}</td>
                                    <td>
                                        <a href="{{ route('customer.histori-reservasi.show', $item->id) }}"
                                            class="btn btn-sm btn-primary">Detail</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">
                                        <div class="alert alert-danger text-center m-0">
                                            Data histori reservasi kosong.
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
@endsection

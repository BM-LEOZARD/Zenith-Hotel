@extends('layouts.app')
@section('title', 'Zenith Hotel | Status Reservasi')
@section('konten')
    <div class="main-container">
        <div class="pd-ltr-20">
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h4 class="text-blue h4">Reservasi Saya</h4>
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
                            @forelse ($reservasi as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->nama_customer }}</td>
                                    <td>{{ $item->dataKamar->nomor_kamar ?? '-' }}</td>
                                    <td>{{ $item->status_pembayaran }}</td>
                                    <td>{{ $item->status_pemesanan }}</td>
                                    <td>
                                        <div class="btn-group">
                                            @if ($item->status_pembayaran == 'Pending' && $item->status_pemesanan != 'Canceled')
                                                <form action="{{ route('customer.status-reservasi.cancel', $item->id) }}"
                                                    method="POST" class="form-batalkan d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="button" class="btn btn-sm btn-warning btn-cancel"
                                                        data-id="{{ $item->id }}">Batalkan</button>
                                                </form>
                                                <form action="{{ route('customer.status-reservasi.pay', $item->id) }}"
                                                    method="POST" class="form-bayar d-inline">
                                                    @csrf
                                                    <button type="button" class="btn btn-sm btn-success btn-pay"
                                                        data-id="{{ $item->id }}">Bayar</button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">
                                        <div class="alert alert-danger text-center m-0">
                                            Tidak ada reservasi yang perlu dibayar.
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
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.btn-cancel').forEach(btn => {
                btn.addEventListener('click', function() {
                    Swal.fire({
                        title: "Batalkan Reservasi?",
                        text: "Reservasi ini akan dibatalkan.",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Ya, batalkan!",
                        cancelButtonText: "Batal"
                    }).then(result => {
                        if (result.isConfirmed) {
                            this.closest('form').submit();
                            const parent = this.closest('td');
                            parent.querySelectorAll('.btn-cancel, .btn-pay').forEach(btn =>
                                btn.style.display = 'none');
                        }
                    });
                });
            });
            document.querySelectorAll('.btn-pay').forEach(btn => {
                btn.addEventListener('click', function() {
                    Swal.fire({
                        title: "Bayar Sekarang?",
                        text: "Lanjutkan ke proses pembayaran?",
                        icon: "info",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#aaa",
                        confirmButtonText: "Ya, bayar!",
                        cancelButtonText: "Batal"
                    }).then(result => {
                        if (result.isConfirmed) {
                            this.closest('form').submit();
                            const parent = this.closest('td');
                            parent.querySelectorAll('.btn-cancel, .btn-pay').forEach(btn =>
                                btn.style.display = 'none');
                        }
                    });
                });
            });
            @if (session('success'))
                Swal.fire({
                    title: "{{ session('success') }}",
                    icon: "success",
                    timer: 3000,
                    showConfirmButton: true,
                });
            @endif
        });
    </script>
@endpush

@extends('layouts.app')
@section('title', 'Zenith Hotel | Data Reservasi')
@section('konten')
    <div class="main-container">
        <div class="pd-ltr-20">
            <div class="mb-3">
            </div>
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h4 class="text-blue h4">Data Reservasi</h4>
                </div>
                <div class="pb-20">
                    <table class="data-table table stripe hover nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Customer</th>
                                <th>Nomor Kamar</th>
                                <th>Status Pembayaran</th>
                                <th>Status Pemesanan</th>
                                <th class="datatable-nosort">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($reservasi->isEmpty())
                                <tr>
                                    <td colspan="6">
                                        <div class="alert alert-danger text-center m-0">
                                            Data reservasi kosong.
                                        </div>
                                    </td>
                                </tr>
                            @else
                                @foreach ($reservasi as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->nama_customer }}</td>
                                        <td>{{ $item->dataKamar->nomor_kamar ?? '-' }}</td>
                                        <td>{{ $item->status_pembayaran }}</td>
                                        <td>{{ $item->status_pemesanan }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                    href="#" role="button" data-toggle="dropdown">
                                                    <i class="dw dw-more"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.data-reservasi.show', $item->id) }}">
                                                        <i class="dw dw-eye"></i> Detail
                                                    </a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.data-reservasi.edit', $item->id) }}">
                                                        <i class="dw dw-edit2"></i> Edit
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
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
            const forms = document.querySelectorAll('.form-hapus-reservasi');
            forms.forEach(form => {
                const btn = form.querySelector('.btn-delete-reservasi');
                btn.addEventListener('click', function() {
                    Swal.fire({
                        title: "Yakin ingin menghapus?",
                        text: "Data reservasi akan dipindahkan ke trash (soft delete).",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Ya, hapus!",
                        cancelButtonText: "Batal"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: "Menghapus...",
                                text: "Mohon tunggu sebentar.",
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            });
                            setTimeout(() => {
                                form.submit();
                            }, 1500);
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
            @if (session('error'))
                Swal.fire({
                    title: "Aksi Ditolak!",
                    text: "{{ session('error') }}",
                    icon: "error",
                    confirmButtonColor: "#d33"
                });
            @endif
        });
    </script>
@endpush

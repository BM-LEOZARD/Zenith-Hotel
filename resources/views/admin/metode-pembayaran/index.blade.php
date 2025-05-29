@extends('layouts.app')
@section('title', 'Zenith Hotel | Metode Pembayaran')
@section('konten')
    <div class="main-container">
        <div class="pd-ltr-20">
            <div class="mb-3">
                <a href="{{ route('admin.metode-pembayaran.create') }}" class="btn btn-primary">+ Tambah Metode Pembayaran</a>
            </div>
            <a href="{{ route('admin.metode-pembayaran.trash') }}" class="btn btn-outline-danger mb-3">
                <i class="fa fa-trash"></i> Sampah
            </a>
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h4 class="text-blue h4">Data Metode Pembayaran</h4>
                </div>
                <div class="pb-20">
                    <table class="data-table table stripe hover nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Metode Pembayaran</th>
                                <th class="datatable-nosort">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($metodePembayaran->isEmpty())
                                <tr>
                                    <td colspan="3">
                                        <div class="alert alert-danger text-center m-0">
                                            Tidak ada data metode pembayaran.
                                        </div>
                                    </td>
                                </tr>
                            @else
                                @foreach ($metodePembayaran as $index => $metode)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $metode->metode_pembayaran }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                    href="#" role="button" data-toggle="dropdown">
                                                    <i class="dw dw-more"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.metode-pembayaran.edit', $metode->id) }}">
                                                        <i class="dw dw-edit2"></i> Edit
                                                    </a>
                                                    <form
                                                        action="{{ route('admin.metode-pembayaran.destroy', $metode->id) }}"
                                                        method="POST" class="form-hapus-metode">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="dropdown-item btn-delete-metode">
                                                            <i class="dw dw-delete-3"></i> Hapus
                                                        </button>
                                                    </form>
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
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const forms = document.querySelectorAll('.form-hapus-metode');
                forms.forEach(form => {
                    const btn = form.querySelector('.btn-delete-metode');
                    btn.addEventListener('click', function() {
                        Swal.fire({
                            title: "Yakin ingin menghapus?",
                            text: "Data akan dipindahkan ke trash.",
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
            });
        </script>
    @endpush
@endsection

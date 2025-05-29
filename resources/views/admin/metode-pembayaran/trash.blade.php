@extends('layouts.app')
@section('title', 'Zenith Hotel | Metode Pembayaran Terhapus')
@section('konten')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header mb-3">
                    <h4 class="text-blue h4">Metode Pembayaran Terhapus</h4>
                    <a href="{{ route('admin.metode-pembayaran.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
                <div class="card-box p-3">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Metode Pembayaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($metodePembayaran as $index => $metodePembayaran)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $metodePembayaran->metode_pembayaran }}</td>
                                    <td>
                                        <form action="{{ route('admin.metode-pembayaran.restore', $metodePembayaran->id) }}"
                                            method="POST" class="form-restore" style="display:inline;">
                                            @csrf
                                            @method('PUT')
                                            <button type="button"
                                                class="btn btn-sm btn-success btn-restore">Pulihkan</button>
                                        </form>
                                        <form
                                            action="{{ route('admin.metode-pembayaran.forceDelete', $metodePembayaran->id) }}"
                                            method="POST" class="form-delete" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-danger btn-force-delete">Hapus
                                                Permanen</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">Tidak ada metode pembayaran yang terhapus.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.querySelectorAll('.btn-restore').forEach(button => {
                button.addEventListener('click', function() {
                    Swal.fire({
                        title: 'Pulihkan pembayaran ini?',
                        text: "Data akan dikembalikan ke daftar pembayaran.",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#28a745',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, pulihkan'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: 'Sedang memulihkan...',
                                text: 'Mohon tunggu sebentar.',
                                icon: 'info',
                                showConfirmButton: false,
                                willOpen: () => {
                                    Swal.showLoading();
                                }
                            });
                            setTimeout(() => {
                                this.closest('form').submit();
                            }, 1000);
                        }
                    });
                });
            });
            document.querySelectorAll('.btn-force-delete').forEach(button => {
                button.addEventListener('click', function() {
                    Swal.fire({
                        title: 'Hapus permanen?',
                        text: "Data ini tidak dapat dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#dc3545',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, hapus permanen'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: 'Sedang menghapus...',
                                text: 'Mohon tunggu sebentar.',
                                icon: 'info',
                                showConfirmButton: false,
                                willOpen: () => {
                                    Swal.showLoading();
                                }
                            });
                            setTimeout(() => {
                                this.closest('form').submit();
                            }, 1000);
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
        </script>
    @endpush
@endsection

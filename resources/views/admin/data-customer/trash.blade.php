@extends('layouts.app')
@section('title', 'Zenith Hotel | Trash Customer')
@section('konten')
    <div class="main-container">
        <div class="pd-ltr-20">
            <div class="card-box mb-30">
                <div class="pd-20 d-flex justify-content-between">
                    <h4 class="text-blue h4">Data Customer Terhapus</h4>
                    <a href="{{ route('admin.data-customer.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
                </div>
                <div class="pb-20">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($customers as $customer)
                                <tr>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->username }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>
                                        <form action="{{ route('admin.data-customer.restore', $customer->id) }}"
                                            method="POST" class="form-restore d-inline">
                                            @csrf @method('PUT')
                                            <button type="button"
                                                class="btn btn-success btn-sm btn-restore">Pulihkan</button>
                                        </form>
                                        <form action="{{ route('admin.data-customer.forceDelete', $customer->id) }}"
                                            method="POST" class="form-delete d-inline">
                                            @csrf @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm btn-force-delete">Hapus
                                                Permanen</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada data.</td>
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
                        title: 'Pulihkan customer ini?',
                        text: "Data akan dikembalikan ke daftar customer.",
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

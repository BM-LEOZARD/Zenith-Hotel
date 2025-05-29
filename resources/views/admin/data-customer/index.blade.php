@extends('layouts.app')
@section('title', 'Zenith Hotel | Data Customer')
@section('konten')
    <div class="main-container">
        <div class="pd-20 d-flex justify-content-between">
            <a href="{{ route('admin.data-customer.trash') }}" class="btn btn-outline-danger mb-3">
                <i class="fa fa-trash"></i> Sampah
            </a>
        </div>
        <div class="pd-ltr-20">
            <div class="card-box mb-30">
                <div class="pd-20 d-flex justify-content-between">
                    <h4 class="text-blue h4">Data Customer</h4>
                </div>
                <div class="pb-20">
                    <table class="data-table table stripe hover nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th class="datatable-nosort">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($customers as $index => $customer)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->username }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                href="#" role="button" data-toggle="dropdown">
                                                <i class="dw dw-more"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                <a class="dropdown-item"
                                                    href="{{ route('admin.data-customer.show', $customer->id) }}">
                                                    <i class="dw dw-eye"></i> Detail
                                                </a>
                                                <form action="{{ route('admin.data-customer.destroy', $customer->id) }}"
                                                    method="POST" class="form-hapus-customer">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="dropdown-item btn-delete-customer">
                                                        <i class="dw dw-delete-3"></i> Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        <div class="alert alert-danger text-center m-0">
                                            Data customer kosong.
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
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const forms = document.querySelectorAll('.form-hapus-customer');
                forms.forEach(form => {
                    const btn = form.querySelector('.btn-delete-customer');
                    btn.addEventListener('click', function() {
                        Swal.fire({
                            title: "Yakin ingin menghapus?",
                            text: "Data customer akan dihapus secara permanen.",
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

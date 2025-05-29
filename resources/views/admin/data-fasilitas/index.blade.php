@extends('layouts.app')
@section('title', 'Zenith Hotel | Data Fasilitas')
@section('konten')
    <div class="main-container">
        <div class="pd-ltr-20">
            <div class="mb-3">
                <a href="{{ route('admin.data-fasilitas.create') }}" class="btn btn-primary">+ Tambah Fasilitas</a>
            </div>
            <a href="{{ route('admin.data-fasilitas.trash') }}" class="btn btn-outline-danger mb-3">
                <i class="fa fa-trash"></i> Sampah
            </a>
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h4 class="text-blue h4">Data Fasilitas</h4>
                </div>
                <div class="pb-20">
                    <table class="data-table table stripe hover nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th class="table-plus datatable-nosort">Gambar</th>
                                <th>Nama Fasilitas</th>
                                <th class="datatable-nosort">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($fasilitas->isEmpty())
                                <tr>
                                    <td colspan="4">
                                        <div class="alert alert-danger text-center m-0">
                                            Data fasilitas kosong.
                                        </div>
                                    </td>
                                </tr>
                            @else
                                @foreach ($fasilitas as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td class="table-plus">
                                            @php
                                                $gambar = $item->gambarFasilitas->first();
                                            @endphp
                                            @if ($gambar)
                                                <img src="{{ asset('storage/' . $gambar->path) }}" width="70"
                                                    height="70"
                                                    onclick="showImageModal('{{ asset('storage/' . $gambar->path) }}')"
                                                    style="cursor: pointer;">
                                            @else
                                                <img src="{{ asset('dashboard/vendors/images/no-image.png') }}"
                                                    width="70" height="70" alt="Tidak ada gambar">
                                            @endif
                                        </td>
                                        <td>{{ $item->nama_fasilitas }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                    href="#" role="button" data-toggle="dropdown">
                                                    <i class="dw dw-more"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.data-fasilitas.show', $item->id) }}">
                                                        <i class="dw dw-eye"></i> Detail
                                                    </a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.data-fasilitas.edit', $item->id) }}">
                                                        <i class="dw dw-edit2"></i> Edit
                                                    </a>
                                                    <form action="{{ route('admin.data-fasilitas.destroy', $item->id) }}"
                                                        method="POST" class="form-hapus-fasilitas">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="dropdown-item btn-delete-fasilitas">
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
    <div class="modal fade" id="gambarModal" tabindex="-1" role="dialog" aria-labelledby="gambarModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <img id="modalGambar" src="" class="img-fluid rounded" alt="Preview Gambar">
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function showImageModal(src) {
            document.getElementById('modalGambar').src = src;
            $('#gambarModal').modal('show');
        }
        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('.form-hapus-fasilitas');
            forms.forEach(form => {
                const btn = form.querySelector('.btn-delete-fasilitas');
                btn.addEventListener('click', function() {
                    Swal.fire({
                        title: "Yakin ingin menghapus?",
                        text: "Data fasilitas yang dihapus akan masuk ke trash.",
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
                                text: "Silakan tunggu sebentar.",
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

@extends('layouts.app')
@section('title', 'Zenith Hotel | Detail Customer')
@section('konten')
    <div class="main-container">
        <div class="pd-ltr-20">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Detail Data Customer</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h4 class="text-blue h4">Data Customer</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Nama Lengkap:</h5>
                            <p>{{ $customer->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Username:</h5>
                            <p>{{ $customer->username }}</p>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Jenis Kelamin:</h5>
                            <p>{{ $customer->jenis_kelamin }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>No. HP:</h5>
                            <p>{{ $customer->no_hp }}</p>
                        </div>
                    </div>
                    <div class="mb-4">
                        <h5>Email:</h5>
                        <p>{{ $customer->email }}</p>
                    </div>
                    <div class="form-group mt-4 text-center d-flex justify-content-center" style="gap: 20px;">
                        <a href="{{ route('admin.data-customer.index') }}" class="btn btn-secondary mt-3">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\DataKamar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        $jumlahTersedia = DataKamar::where('status_kamar', 'Tersedia')->count();
        $jumlahTerisi = DataKamar::where('status_kamar', 'Terisi')->count();
        $jumlahDiperbaiki = DataKamar::where('status_kamar', 'Diperbaiki')->count();
        $jumlahUser = User::where('role', 'Customer')->count();
        return view('admin.dashboard', compact('jumlahTersedia', 'jumlahTerisi', 'jumlahDiperbaiki', 'jumlahUser'));
    }
}

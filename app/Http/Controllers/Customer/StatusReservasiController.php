<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Models\DataReservasi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StatusReservasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $reservasi = DataReservasi::with('dataKamar')
            ->where('user_id', Auth::id())
            ->where('status_pembayaran', 'Pending')
            ->where('status_pemesanan', '!=', 'Canceled')
            ->latest()
            ->get();
        return view('customer.status-reservasi.index', compact('reservasi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function batalkan($id)
    {
        $reservasi = DataReservasi::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        if ($reservasi->status_pembayaran === 'Pending' && $reservasi->status_pemesanan !== 'Canceled') {
            $reservasi->update(['status_pemesanan' => 'Canceled']);
        }
        return redirect()->back()->with('success', 'Reservasi berhasil dibatalkan.');
    }
    public function bayar($id)
    {
        $reservasi = DataReservasi::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        if ($reservasi->status_pembayaran === 'Pending' && $reservasi->status_pemesanan !== 'Canceled') {
            $reservasi->update(['status_pembayaran' => 'Paid']);
        }
        return redirect()->back()->with('success', 'Pembayaran berhasil dilakukan.');
    }
}

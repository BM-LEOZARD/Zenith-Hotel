<?php

namespace App\Http\Controllers\Admin;

use App\Models\DataKamar;
use Illuminate\Http\Request;
use App\Models\DataReservasi;
use App\Http\Controllers\Controller;

class DataReservasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservasi = DataReservasi::with('dataKamar')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.data-reservasi.index', compact('reservasi'));
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
        $reservasi = DataReservasi::with('dataKamar')->findOrFail($id);
        return view('admin.data-reservasi.show', compact('reservasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $reservasi = DataReservasi::with('dataKamar')->findOrFail($id);
        if (in_array($reservasi->status_pemesanan, ['Complete', 'Canceled'])) {
            return redirect()->route('admin.data-reservasi.index')
                ->with('error', 'Reservasi yang sudah selesai atau dibatalkan tidak dapat diedit.');
        }
        $statusPembayaranOptions = match ($reservasi->status_pembayaran) {
            'Pending' => ['Pending', 'Paid', 'Verified'],
            'Paid' => ['Paid', 'Verified'],
            default => ['Verified'],
        };
        $kamarTersedia = DataKamar::where('tipe_kamar', $reservasi->dataKamar->tipe_kamar)
            ->where(function ($query) use ($reservasi) {
                $query->where('status_kamar', 'Tersedia')
                    ->orWhere('id', $reservasi->data_kamar_id);
            })->get();
        return view('admin.data-reservasi.edit', compact(
            'reservasi',
            'statusPembayaranOptions',
            'kamarTersedia'
        ));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $reservasi = DataReservasi::findOrFail($id);
        if (in_array($reservasi->status_pemesanan, ['Complete', 'Canceled'])) {
            return redirect()->route('admin.data-reservasi.index')
                ->with('error', 'Reservasi yang sudah selesai atau dibatalkan tidak dapat diubah.');
        }
        $request->validate([
            'status_pembayaran' => 'required|in:Pending,Paid,Verified',
            'data_kamar_id' => 'required|exists:data_kamar,id',
            
        ]);
        $kamarLama = DataKamar::find($reservasi->data_kamar_id);
        $kamarBaru = DataKamar::find($request->data_kamar_id);
        $reservasi->status_pembayaran = $request->status_pembayaran;
        $reservasi->data_kamar_id = $request->data_kamar_id;
        if ($request->status_pembayaran === 'Verified') {
            $reservasi->status_pemesanan = 'Check-In';
        } elseif (!in_array($reservasi->status_pemesanan, ['Check-In', 'Complete'])) {
            $reservasi->status_pemesanan = 'Canceled';
        }
        $reservasi->save();
        if ($kamarLama && $kamarLama->id !== $kamarBaru->id) {
            $masihAda = DataReservasi::where('data_kamar_id', $kamarLama->id)
                ->whereIn('status_pemesanan', ['Check-In', 'Verified'])
                ->where('id', '!=', $reservasi->id)
                ->exists();
            if (! $masihAda) {
                $kamarLama->status_kamar = 'Tersedia';
                $kamarLama->save();
            }
        }
        if ($kamarBaru) {
            $kamarBaru->status_kamar = in_array($reservasi->status_pemesanan, ['Complete', 'Canceled']) ? 'Tersedia' : 'Terisi';
            $kamarBaru->save();
        }
        return redirect()->route('admin.data-reservasi.index')
            ->with('success', 'Status reservasi berhasil diperbarui.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\DataKamar;
use Illuminate\Http\Request;
use App\Models\DataReservasi;
use App\Models\MetodePembayaran;
use Illuminate\Support\Facades\Auth;

class ReservasiController extends Controller
{
    public function index()
    {
        $kamar = DataKamar::with('gambarKamar')->paginate(8);
        return view('reservasi', compact('kamar'));
    }
    public function detail($id)
    {
        $kamar = DataKamar::with('gambarKamar')->findOrFail($id);
        return view('detail-reservasi', compact('kamar'));
    }
    public function create($id)
    {
        $kamar = DataKamar::with('gambarKamar')->findOrFail($id);
        $metodePembayaran = MetodePembayaran::whereNull('deleted_at')->get();
        return view('buat-reservasi', compact('kamar', 'metodePembayaran'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_customer' => 'required|string|max:255',
            'data_kamar_id' => 'required|exists:data_kamar,id',
            'tanggal_check_in' => 'required|date|after_or_equal:today',
            'tanggal_check_out' => 'required|date|after:tanggal_check_in',
            'jumlah_tamu' => 'required|integer|min:1|max:4',
            'metode_pembayaran' => 'required|string|max:100',
            'no_rekening' => 'required|string|max:50',
            'tipe_kamar' => 'required|in:Standard,Superior,Deluxe,Executive',
        ]);
        $kamar = DataKamar::findOrFail($request->data_kamar_id);
        $kamarTerpakai = DataReservasi::where('data_kamar_id', $request->data_kamar_id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('tanggal_check_in', [$request->tanggal_check_in, $request->tanggal_check_out])
                    ->orWhereBetween('tanggal_check_out', [$request->tanggal_check_in, $request->tanggal_check_out])
                    ->orWhere(function ($query) use ($request) {
                        $query->where('tanggal_check_in', '<=', $request->tanggal_check_in)
                            ->where('tanggal_check_out', '>=', $request->tanggal_check_out);
                    });
            })
            ->exists();
        if ($kamarTerpakai) {
            return back()->withErrors(['data_kamar_id' => 'Kamar ini sudah dipesan untuk tanggal yang dipilih.'])->withInput();
        }
        $checkIn = Carbon::parse($request->tanggal_check_in);
        $checkOut = Carbon::parse($request->tanggal_check_out);
        $durasi = $checkIn->diffInDays($checkOut);
        $hargaPerMalam = $kamar->harga_per_malam;
        $totalHarga = max($durasi, 1) * $hargaPerMalam;
        DataReservasi::create([
            'user_id' => Auth::id(),
            'nama_customer' => $request->nama_customer,
            'data_kamar_id' => $request->data_kamar_id,
            'tanggal_check_in' => $request->tanggal_check_in,
            'tanggal_check_out' => $request->tanggal_check_out,
            'jumlah_tamu' => $request->jumlah_tamu,
            'tipe_kamar' => $request->tipe_kamar,
            'metode_pembayaran' => $request->metode_pembayaran,
            'no_rekening' => $request->no_rekening,
            'status_pembayaran' => 'Pending',
            'status_pemesanan' => 'Pending',
            'harga' => $hargaPerMalam,
            'total_harga' => $totalHarga,
        ]);
        return redirect('/')->with('success', 'Reservasi berhasil dibuat!');
    }
    public function cariKamar(Request $request)
    {
        $request->validate([
            'tanggal_check_in' => 'required|date|after_or_equal:today',
            'tanggal_check_out' => 'required|date|after:tanggal_check_in',
        ]);
        $query = DataKamar::with('gambarKamar');
        if ($request->filled('tipe_kamar')) {
            $query->where('tipe_kamar', $request->tipe_kamar);
        }
        if ($request->filled('harga_min')) {
            $query->where('harga_per_malam', '>=', $request->harga_min);
        }
        if ($request->filled('harga_max')) {
            $query->where('harga_per_malam', '<=', $request->harga_max);
        }
        $kamarIdsTerpakai = DataReservasi::where(function ($q) use ($request) {
            $q->whereBetween('tanggal_check_in', [$request->tanggal_check_in, $request->tanggal_check_out])
                ->orWhereBetween('tanggal_check_out', [$request->tanggal_check_in, $request->tanggal_check_out])
                ->orWhere(function ($q) use ($request) {
                    $q->where('tanggal_check_in', '<=', $request->tanggal_check_in)
                        ->where('tanggal_check_out', '>=', $request->tanggal_check_out);
                });
        })->pluck('data_kamar_id');
        $kamar = $query->whereNotIn('id', $kamarIdsTerpakai)->get();
        return view('halaman-reservasi', compact('kamar'));
    }
    public function filter(Request $request)
    {
        $jumlahFilter = collect($request->only([
            'tipe_kamar',
            'harga_min',
            'harga_max',
            'tanggal_check_in',
            'tanggal_check_out',
        ]))->filter()->count();
        if ($jumlahFilter < 1 || $jumlahFilter > 5) {
            return redirect()->back()->withErrors(['filter' => 'Pilih minimal 1 dan maksimal 5 kriteria pencarian.'])->withInput();
        }
        $query = DataKamar::with('gambarKamar');
        if ($request->filled('tipe_kamar')) {
            $query->where('tipe_kamar', $request->tipe_kamar);
        }
        if ($request->filled('harga_min')) {
            $query->where('harga_per_malam', '>=', $request->harga_min);
        }
        if ($request->filled('harga_max')) {
            $query->where('harga_per_malam', '<=', $request->harga_max);
        }
        if ($request->filled('tanggal_check_in') && $request->filled('tanggal_check_out')) {
            $checkIn = $request->tanggal_check_in;
            $checkOut = $request->tanggal_check_out;
            $query->whereDoesntHave('reservasi', function ($q) use ($checkIn, $checkOut) {
                $q->where(function ($query) use ($checkIn, $checkOut) {
                    $query->whereBetween('tanggal_check_in', [$checkIn, $checkOut])
                        ->orWhereBetween('tanggal_check_out', [$checkIn, $checkOut])
                        ->orWhere(function ($query) use ($checkIn, $checkOut) {
                            $query->where('tanggal_check_in', '<=', $checkIn)
                                ->where('tanggal_check_out', '>=', $checkOut);
                        });
                });
            });
        }
        $kamar = $query->get();
        return view('reservasi', compact('kamar'));
    }
}

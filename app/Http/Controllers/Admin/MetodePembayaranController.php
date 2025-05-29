<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\MetodePembayaran;
use App\Http\Controllers\Controller;

class MetodePembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $metodePembayaran = MetodePembayaran::get();
        return view('admin.metode-pembayaran.index', compact('metodePembayaran'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.metode-pembayaran.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'metode_pembayaran' => 'required|min:3|max:50',
        ]);
        MetodePembayaran::create($validated);
        return redirect()->route('admin.metode-pembayaran.index')->with('success', 'Metode Pembayaran berhasil ditambahkan.');
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
        $metodePembayaran = MetodePembayaran::findOrFail($id);
        return view('admin.metode-pembayaran.edit', compact('metodePembayaran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'metode_pembayaran' => 'required|min:3|max:50',
        ]);
        $metodePembayaran = MetodePembayaran::findOrFail($id);
        $metodePembayaran->update($validated);
        return redirect()->route('admin.metode-pembayaran.index')->with('success', 'Metode Pembayaran berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $metodePembayaran = MetodePembayaran::findOrFail($id);
        $metodePembayaran->delete();
        return redirect()->route('admin.metode-pembayaran.index')->with('success', 'Metode pembayaran berhasil dihapus.');
    }
    public function trash()
    {
        $metodePembayaran = MetodePembayaran::onlyTrashed()->get();
        return view('admin.metode-pembayaran.trash', compact('metodePembayaran'));
    }
    public function restore($id)
    {
        $metodePembayaran = MetodePembayaran::onlyTrashed()->findOrFail($id);
        $metodePembayaran->restore();
        return redirect()->route('admin.metode-pembayaran.trash')->with('success', 'Metode pembayaran berhasil dipulihkan.');
    }
    public function forceDelete($id)
    {
        $metodePembayaran = MetodePembayaran::onlyTrashed()->findOrFail($id);
        $metodePembayaran->forceDelete();
        return redirect()->route('admin.metode-pembayaran.trash')->with('success', 'Metode pembayaran dihapus permanen.');
    }
}

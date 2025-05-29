<?php

namespace App\Http\Controllers\Admin;

use App\Models\DataKamar;
use App\Models\GambarKamar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Dflydev\DotAccessData\Data;
use Illuminate\Support\Facades\Storage;

class DataKamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kamar = DataKamar::get();
        return view('admin.data-kamar.index', compact('kamar'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.data-kamar.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nomor_kamar' => 'required|string|max:10',
            'tipe_kamar' => 'required|string',
            'harga_per_malam' => 'required|numeric',
            'status_kamar' => 'required|string',
            'deskripsi_kamar' => 'required|string',
            'gambar.*' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);
        $kamar = new DataKamar();
        $kamar->nomor_kamar = $request->nomor_kamar;
        $kamar->tipe_kamar = $request->tipe_kamar;
        $kamar->harga_per_malam = $request->harga_per_malam;
        $kamar->status_kamar = $request->status_kamar;
        $kamar->deskripsi_kamar = $request->deskripsi_kamar;
        $kamar->save();
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $key => $gambar) {
                if ($key >= 5) break;
                $path = $gambar->store('GambarKamar', 'public');
                $gambarKamar = new GambarKamar();
                $gambarKamar->data_kamar_id = $kamar->id;
                $gambarKamar->path = $path;
                $gambarKamar->save();
            }
        }
        return redirect()->route('admin.data-kamar.index')->with('success', 'Data kamar berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kamar = DataKamar::with('GambarKamar')->findOrFail($id);
        return view('admin.data-kamar.show', compact('kamar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kamar = DataKamar::with('GambarKamar')->findOrFail($id);
        return view('admin.data-kamar.edit', compact('kamar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kamar = DataKamar::findOrFail($id);
        $request->validate([
            'nomor_kamar' => 'required|string|max:10',
            'tipe_kamar' => 'required|string',
            'harga_per_malam' => 'required|numeric',
            'status_kamar' => 'required|string',
            'deskripsi_kamar' => 'required|string',
            'gambar.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'hapus_gambar.*' => 'nullable|integer|exists:gambar_kamar,id'
        ]);
        $kamar->update($request->only(['nomor_kamar', 'tipe_kamar', 'harga_per_malam', 'status_kamar', 'deskripsi_kamar']));
        if ($request->filled('hapus_gambar')) {
            foreach ($request->hapus_gambar as $idGambar) {
                if ($idGambar) {
                    $gambar = GambarKamar::find($idGambar);
                    if ($gambar && Storage::disk('public')->exists($gambar->path)) {
                        Storage::disk('public')->delete($gambar->path);
                        $gambar->delete();
                    }
                }
            }
        }
        if ($request->hasFile('gambar')) {
            $jumlahLama = $kamar->gambarKamar()->count();
            $jumlahBaru = count($request->file('gambar'));
            if (($jumlahLama + $jumlahBaru) > 5) {
                return back()->withErrors(['gambar' => 'Total gambar maksimal 5.'])->withInput();
            }
            foreach ($request->file('gambar') as $gambar) {
                if ($gambar) {
                    $path = $gambar->store('GambarKamar', 'public');
                    GambarKamar::create([
                        'data_kamar_id' => $kamar->id,
                        'path' => $path
                    ]);
                }
            }
        }
        return redirect()->route('admin.data-kamar.index')->with('success', 'Data kamar berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kamar = DataKamar::findOrFail($id);
        foreach ($kamar->gambarKamar as $gambar) {
            $gambar->delete();
        }
        $kamar->delete();
        return redirect()->route('admin.data-kamar.index')->with('success', 'Data kamar berhasil dihapus.');
    }
    public function trash()
    {
        $kamar = DataKamar::onlyTrashed()->get();
        return view('admin.data-kamar.trash', compact('kamar'));
    }
    public function restore($id)
    {
        $kamar = DataKamar::onlyTrashed()->findOrFail($id);
        $kamar->restore();
        return redirect()->route('admin.data-kamar.trash')->with('success', 'Data kamar berhasil dipulihkan.');
    }
    public function forceDelete($id)
    {
        $kamar = DataKamar::onlyTrashed()->findOrFail($id);
        foreach ($kamar->gambarKamar()->withTrashed()->get() as $gambar) {
            if (Storage::disk('public')->exists($gambar->path)) {
                Storage::disk('public')->delete($gambar->path);
            }
            $gambar->forceDelete();
        }
        $kamar->forceDelete();
        return redirect()->route('admin.data-kamar.trash')->with('success', 'Data kamar dihapus permanen.');
    }
}

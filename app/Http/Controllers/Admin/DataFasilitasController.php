<?php

namespace App\Http\Controllers\Admin;

use App\Models\DataFasilitas;
use App\Models\GambarFasilitas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class DataFasilitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fasilitas = DataFasilitas::get();
        return view('admin.data-fasilitas.index', compact('fasilitas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.data-fasilitas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_fasilitas' => 'required|string|max:255',
            'deskripsi_fasilitas' => 'required|string',
            'gambar.*' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);
        $fasilitas = new DataFasilitas();
        $fasilitas->nama_fasilitas = $request->nama_fasilitas;
        $fasilitas->deskripsi_fasilitas = $request->deskripsi_fasilitas;
        $fasilitas->save();
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $key => $gambar) {
                if ($key >= 5) break;
                $path = $gambar->store('GambarFasilitas', 'public');
                $gambarFasilitas = new GambarFasilitas();
                $gambarFasilitas->data_fasilitas_id = $fasilitas->id;
                $gambarFasilitas->path = $path;
                $gambarFasilitas->save();
            }
        }
        return redirect()->route('admin.data-fasilitas.index')->with('success', 'Data fasilitas berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $fasilitas = DataFasilitas::with('GambarFasilitas')->findOrFail($id);
        return view('admin.data-fasilitas.show', compact('fasilitas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $fasilitas = DataFasilitas::with('GambarFasilitas')->findOrFail($id);
        return view('admin.data-fasilitas.edit', compact('fasilitas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $fasilitas = DataFasilitas::findOrFail($id);
        $request->validate([
            'nama_fasilitas' => 'required|string|max:255',
            'deskripsi_fasilitas' => 'required|string',
            'gambar.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'hapus_gambar.*' => 'nullable|integer|exists:gambar_fasilitas,id'
        ]);
        $fasilitas->update($request->only(['nama_fasilitas', 'deskripsi_fasilitas']));
        if ($request->filled('hapus_gambar')) {
            foreach ($request->hapus_gambar as $idGambar) {
                if ($idGambar) {
                    $gambar = GambarFasilitas::find($idGambar);
                    if ($gambar && Storage::disk('public')->exists($gambar->path)) {
                        Storage::disk('public')->delete($gambar->path);
                        $gambar->delete();
                    }
                }
            }
        }
        if ($request->hasFile('gambar')) {
            $jumlahLama = $fasilitas->gambarFasilitas()->count();
            $jumlahBaru = count($request->file('gambar'));
            if (($jumlahLama + $jumlahBaru) > 5) {
                return back()->withErrors(['gambar' => 'Total gambar maksimal 5.'])->withInput();
            }
            foreach ($request->file('gambar') as $gambar) {
                if ($gambar) {
                    $path = $gambar->store('GambarFasilitas', 'public');
                    GambarFasilitas::create([
                        'data_fasilitas_id' => $fasilitas->id,
                        'path' => $path
                    ]);
                }
            }
        }
        return redirect()->route('admin.data-fasilitas.index')->with('success', 'Data fasilitas berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $fasilitas = DataFasilitas::findOrFail($id);
        foreach ($fasilitas->gambarFasilitas as $gambar) {
            $gambar->delete();
        }
        $fasilitas->delete();
        return redirect()->route('admin.data-fasilitas.index')->with('success', 'Data fasilitas berhasil dihapus.');
    }
    public function trash()
    {
        $fasilitas = DataFasilitas::onlyTrashed()->get();
        return view('admin.data-fasilitas.trash', compact('fasilitas'));
    }
    public function restore($id)
    {
        $fasilitas = DataFasilitas::onlyTrashed()->findOrFail($id);
        $fasilitas->restore();
        return redirect()->route('admin.data-fasilitas.trash')->with('success', 'Data fasilitas berhasil dipulihkan.');
    }
    public function forceDelete($id)
    {
        $fasilitas = DataFasilitas::onlyTrashed()->findOrFail($id);
        foreach ($fasilitas->gambarFasilitas()->withTrashed()->get() as $gambar) {
            if (Storage::disk('public')->exists($gambar->path)) {
                Storage::disk('public')->delete($gambar->path);
            }
            $gambar->forceDelete();
        }
        $fasilitas->forceDelete();
        return redirect()->route('admin.data-fasilitas.trash')->with('success', 'Data fasilitas dihapus permanen.');
    }
}

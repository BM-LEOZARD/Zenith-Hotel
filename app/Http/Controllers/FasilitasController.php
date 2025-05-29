<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataFasilitas;

class FasilitasController extends Controller
{
    public function fasilitas()
    {
        $fasilitas = DataFasilitas::with('gambarFasilitas')->latest()->paginate(8);
        return view('fasilitas', compact('fasilitas'));
    }
    public function show($id)
    {
        $fasilitas = DataFasilitas::with('gambarFasilitas')->findOrFail($id);
        return view('detail-fasilitas', compact('fasilitas'));
    }
}

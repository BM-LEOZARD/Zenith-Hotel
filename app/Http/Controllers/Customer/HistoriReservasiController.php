<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Models\DataReservasi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HistoriReservasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $histori = DataReservasi::with('dataKamar')->where('user_id', Auth::id())->latest()->get();
        return view('customer.histori-reservasi.index', compact('histori'));
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
        $histori = DataReservasi::with('dataKamar')->where('user_id', Auth::id())->findOrFail($id);
        return view('customer.histori-reservasi.show', compact('histori'));
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
}

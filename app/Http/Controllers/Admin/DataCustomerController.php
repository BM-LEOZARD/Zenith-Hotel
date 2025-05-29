<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DataCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = User::where('role', 'customer')->whereNull('deleted_at')->get();
        return view('admin.data-customer.index', compact('customers'));
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
        $customer = User::findOrFail($id);
        return view('admin.data-customer.show', compact('customer'));
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
        $customer = User::findOrFail($id);
        $customer->delete();
        return redirect()->route('admin.data-customer.index')->with('success', 'Customer berhasil dihapus.');
    }
    public function trash()
    {
        $customers = User::onlyTrashed()->where('role', 'Customer')->get();
        return view('admin.data-customer.trash', compact('customers'));
    }
    public function restore($id)
    {
        $customer = User::onlyTrashed()->findOrFail($id);
        $customer->restore();
        return redirect()->route('admin.data-customer.trash')->with('success', 'Customer berhasil dipulihkan.');
    }
    public function forceDelete($id)
    {
        $customer = User::onlyTrashed()->findOrFail($id);
        $customer->forceDelete();
        return redirect()->route('admin.data-customer.trash')->with('success', 'Customer dihapus permanen.');
    }
}

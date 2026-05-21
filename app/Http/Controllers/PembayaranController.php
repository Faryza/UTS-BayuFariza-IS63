<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Penyewa;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pembayarans = Pembayaran::with('penyewa.kamar')->latest()->get();
        return view('pembayaran.index', compact('pembayarans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get all tenants with their room info to make selection easy
        $penyewas = Penyewa::with('kamar')->orderBy('nama')->get();
        return view('pembayaran.create', compact('penyewas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'penyewa_id' => 'required|exists:penyewas,id',
            'tanggal_bayar' => 'required|date',
            'jumlah' => 'required|integer|min:0',
            'metode_pembayaran' => 'required|string|in:Transfer,Tunai',
            'status' => 'required|string|in:Lunas,Belum Lunas',
            'keterangan' => 'nullable|string',
        ]);

        Pembayaran::create($request->all());

        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil dicatat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pembayaran $pembayaran)
    {
        return redirect()->route('pembayaran.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pembayaran $pembayaran)
    {
        $penyewas = Penyewa::with('kamar')->orderBy('nama')->get();
        return view('pembayaran.edit', compact('pembayaran', 'penyewas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pembayaran $pembayaran)
    {
        $request->validate([
            'penyewa_id' => 'required|exists:penyewas,id',
            'tanggal_bayar' => 'required|date',
            'jumlah' => 'required|integer|min:0',
            'metode_pembayaran' => 'required|string|in:Transfer,Tunai',
            'status' => 'required|string|in:Lunas,Belum Lunas',
            'keterangan' => 'nullable|string',
        ]);

        $pembayaran->update($request->all());

        return redirect()->route('pembayaran.index')->with('success', 'Data pembayaran berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pembayaran $pembayaran)
    {
        $pembayaran->delete();
        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Penyewa;
use App\Models\Kamar;
use Illuminate\Http\Request;

class PenyewaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penyewas = Penyewa::with('kamar')->latest()->get();
        return view('penyewa.index', compact('penyewas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Only get available rooms
        $kamars = Kamar::where('status', 'Tersedia')->orderBy('nomor_kamar')->get();
        return view('penyewa.create', compact('kamars'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'pekerjaan' => 'nullable|string|max:255',
            'kamar_id' => 'required|exists:kamars,id',
            'tanggal_masuk' => 'required|date',
        ]);

        $penyewa = Penyewa::create($request->all());

        // Update the assigned room's status to 'Terisi'
        if ($penyewa->kamar_id) {
            Kamar::where('id', $penyewa->kamar_id)->update(['status' => 'Terisi']);
        }

        return redirect()->route('penyewa.index')->with('success', 'Penyewa berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Penyewa $penyewa)
    {
        return redirect()->route('penyewa.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penyewa $penyewa)
    {
        // Get available rooms plus the room currently rented by this tenant
        $kamars = Kamar::where('status', 'Tersedia')
            ->orWhere('id', $penyewa->kamar_id)
            ->orderBy('nomor_kamar')
            ->get();

        return view('penyewa.edit', compact('penyewa', 'kamars'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penyewa $penyewa)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'pekerjaan' => 'nullable|string|max:255',
            'kamar_id' => 'required|exists:kamars,id',
            'tanggal_masuk' => 'required|date',
        ]);

        $oldKamarId = $penyewa->kamar_id;
        $newKamarId = $request->kamar_id;

        $penyewa->update($request->all());

        // If the room has changed
        if ($oldKamarId != $newKamarId) {
            // Free the old room
            if ($oldKamarId) {
                Kamar::where('id', $oldKamarId)->update(['status' => 'Tersedia']);
            }
            // Occupy the new room
            if ($newKamarId) {
                Kamar::where('id', $newKamarId)->update(['status' => 'Terisi']);
            }
        }

        return redirect()->route('penyewa.index')->with('success', 'Data penyewa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penyewa $penyewa)
    {
        $kamarId = $penyewa->kamar_id;

        $penyewa->delete();

        // If the tenant had a room, mark it as available again
        if ($kamarId) {
            Kamar::where('id', $kamarId)->update(['status' => 'Tersedia']);
        }

        return redirect()->route('penyewa.index')->with('success', 'Penyewa berhasil dihapus.');
    }
}

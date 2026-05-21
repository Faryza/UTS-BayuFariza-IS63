<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kamar;
use App\Models\Penyewa;
use App\Models\Pembayaran;

class DashboardController extends Controller
{
    public function index()
    {
        $totalKamar = Kamar::count();
        $kamarTerisi = Kamar::where('status', 'Terisi')->count();
        $kamarTersedia = Kamar::where('status', 'Tersedia')->count();
        $totalPenyewa = Penyewa::count();
        $totalPendapatan = Pembayaran::where('status', 'Lunas')->sum('jumlah');
        
        $recentPayments = Pembayaran::with('penyewa.kamar')
            ->latest()
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'totalKamar',
            'kamarTerisi',
            'kamarTersedia',
            'totalPenyewa',
            'totalPendapatan',
            'recentPayments'
        ));
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'penyewa_id',
        'tanggal_bayar',
        'jumlah',
        'metode_pembayaran',
        'status',
        'keterangan',
    ];

    public function penyewa(): BelongsTo
    {
        return $this->belongsTo(Penyewa::class);
    }
}

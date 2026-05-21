<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kamar extends Model
{
    use HasFactory;
    protected $fillable = [
        'nomor_kamar',
        'tipe_kamar',
        'harga_bulanan',
        'status',
    ];

    public function penyewas(): HasMany
    {
        return $this->hasMany(Penyewa::class);
    }
}

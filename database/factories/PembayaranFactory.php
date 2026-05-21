<?php

namespace Database\Factories;

use App\Models\Pembayaran;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Pembayaran>
 */
class PembayaranFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'penyewa_id' => null, // Linked in Seeder
            'tanggal_bayar' => $this->faker->date('Y-m-d', 'now'),
            'jumlah' => $this->faker->randomElement([1000000, 1500000, 2500000]),
            'metode_pembayaran' => $this->faker->randomElement(['Transfer', 'Tunai']),
            'status' => $this->faker->randomElement(['Lunas', 'Belum Lunas']),
            'keterangan' => 'Pembayaran sewa bulan ' . $this->faker->monthName(),
        ];
    }
}

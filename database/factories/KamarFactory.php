<?php

namespace Database\Factories;

use App\Models\Kamar;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Kamar>
 */
class KamarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected static $counter = 101;

    public function definition(): array
    {
        $types = ['Standard', 'Deluxe', 'Suite'];
        $prices = [
            'Standard' => 1000000,
            'Deluxe' => 1500000,
            'Suite' => 2500000
        ];
        
        $type = $this->faker->randomElement($types);
        $roomNo = 'Room ' . self::$counter++;

        return [
            'nomor_kamar' => $roomNo,
            'tipe_kamar' => $type,
            'harga_bulanan' => $prices[$type],
            'status' => 'Tersedia',
        ];
    }
}

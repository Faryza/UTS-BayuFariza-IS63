<?php

namespace Database\Factories;

use App\Models\Penyewa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Penyewa>
 */
class PenyewaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $occupations = ['Mahasiswa', 'Karyawan Swasta', 'PNS', 'Freelancer', 'Wirausaha'];
        return [
            'nama' => $this->faker->name(),
            'no_hp' => '08' . $this->faker->numerify('##########'),
            'email' => $this->faker->unique()->safeEmail(),
            'pekerjaan' => $this->faker->randomElement($occupations),
            'kamar_id' => null, // Will be linked properly in the Seeder
            'tanggal_masuk' => $this->faker->date('Y-m-d', '-6 months'),
        ];
    }
}

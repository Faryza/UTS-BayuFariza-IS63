<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Kamar;
use App\Models\Penyewa;
use App\Models\Pembayaran;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create a default admin user
        User::factory()->create([
            'name' => 'Admin Kost',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'), // standard bcrypt password
        ]);

        // 2. Create 10 rooms
        $rooms = Kamar::factory(10)->create();

        // 3. Create 6 tenants
        // Select 6 random rooms to occupy
        $occupiedRooms = $rooms->random(6);

        foreach ($occupiedRooms as $room) {
            // Create a tenant for this room
            $tenant = Penyewa::factory()->create([
                'kamar_id' => $room->id,
            ]);

            // Update room status to 'Terisi'
            $room->update(['status' => 'Terisi']);

            // Create 1-3 payments for this tenant
            $paymentCount = rand(1, 3);
            for ($i = 0; $i < $paymentCount; $i++) {
                Pembayaran::factory()->create([
                    'penyewa_id' => $tenant->id,
                    'jumlah' => $room->harga_bulanan,
                    // Random date in the last few months, but after tenant check-in
                    'tanggal_bayar' => date('Y-m-d', strtotime($tenant->tanggal_masuk . " + " . ($i * 30) . " days")),
                ]);
            }
        }
    }
}

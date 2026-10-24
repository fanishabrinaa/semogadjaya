<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['Rina',  'Pelanggan Setia', 'Kopinya enak dan tempatnya nyaman banget!', 5],
            ['Budi',  'Pelanggan Setia', 'Pelayanan cepat, latte-nya juara.',          5],
            ['Sinta', 'Pelanggan Baru',  'Brownies-nya lembut, pasti balik lagi.',     4],
        ];

        foreach ($items as [$name, $role, $content, $rating]) {
            Testimonial::create([
                'name' => $name, 'role' => $role,
                'content' => $content, 'rating' => $rating, 'is_active' => true,
            ]);
        }
    }
}
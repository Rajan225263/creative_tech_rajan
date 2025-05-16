<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bookshelf;

class BookshelfSeeder extends Seeder
{
    public function run(): void
    {
        $locations = ['Dhaka', 'Chittagong', 'Khulna', 'Noakhali', 'Barisal'];
        foreach (range(1, 10) as $i) {
            Bookshelf::create([
                'name' => 'Bookshelf ' . $i,
                'location' => $locations[array_rand($locations)],
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Bookshelf;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $authors = [
            'Rabindranath Tagore' => ['Gitanjali', 'Gora', 'Kabuliwala', 'Chokher Bali'],
            'Kazi Nazrul Islam' => ['Bidrohi', 'Agnibina', 'Bhangar Gaan', 'Dolonchampa'],
            'Jasimuddin' => ['Nakshi Kanthar Math', 'Sojan Badiar Ghat', 'Beder Meye', 'Rakhali']
        ];

        foreach ($authors as $author => $titles) {
            foreach ($titles as $title) {
                Book::create([
                    'title' => $title,
                    'author' => $author,
                    'published_year' => rand(1920, 2025),
                    'bookshelf_id' => Bookshelf::inRandomOrder()->first()->id,
                ]);
            }
        }

    }
}


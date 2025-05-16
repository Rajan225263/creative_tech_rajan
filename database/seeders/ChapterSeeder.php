<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Chapter;
use App\Models\Book;

class ChapterSeeder extends Seeder
{
    public function run(): void
    {
        foreach (Book::all() as $book) {
            foreach (range(1, 5) as $i) {
                Chapter::create([
                    'title' => 'Chapter ' . $i . ' of ' . $book->title,
                    'chapter_number' => $i,
                    'book_id' => $book->id,
                ]);
            }
        }
    }
}


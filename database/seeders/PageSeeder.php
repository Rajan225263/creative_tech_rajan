<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\Chapter;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        foreach (Chapter::all() as $chapter) {
            foreach (range(1, 4) as $pageNumber) {
                Page::create([
                    'page_number' => $pageNumber,
                    'content' => 'Sample content for page ' . $pageNumber . ' of ' . $chapter->title,
                    'chapter_id' => $chapter->id,
                ]);
            }
        }
    }
}


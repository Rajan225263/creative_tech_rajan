<?php

namespace App\Repositories\ChapterRepository;

use App\Models\Chapter;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ChapterRepository extends BaseRepository implements ChapterRepositoryContact
{
    public function __construct(Chapter $model)
    {
        parent::__construct($model);
    }

    public function getAll(array $with = ['book']): Collection
    {
        return $this->model->with($with)->get();
    }

    public function findOrFail(int $id): Model
    {
        return $this->model->with(['book'])->findOrFail($id);
    }

    public function getFullContent(int $chapterId): string
    {
        $chapter = $this->model->with(['pages'])->findOrFail($chapterId);

        return $chapter->pages
            ->sortBy('page_number')
            ->map(function ($page) {
                return "Page {$page->page_number}:\n{$page->content}";
            })
            ->implode("\n\n"); // Separate pages with two newlines
    }

}

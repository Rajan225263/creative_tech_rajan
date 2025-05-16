<?php

namespace App\Repositories\BookRepository;

use App\Models\Book;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BookRepository extends BaseRepository implements BookRepositoryContact
{
    public function __construct(Book $model)
    {
        parent::__construct($model);
    }

    public function getAll(array $with = ['bookshelf']): Collection
    {
        return $this->model->with($with)->get();
    }

    public function findOrFail(int $id): Model
    {
        return $this->model->with(['bookshelf', 'chapters', 'chapters.pages'])->findOrFail($id);
    }

    public function search(string $query): Collection
    {
        return $this->model
            ->where('title', 'like', "%{$query}%")
            ->orWhere('author', 'like', "%{$query}%")
            ->with(['bookshelf', 'chapters.pages']) // optional: eager load relations
            ->get();
    }

}

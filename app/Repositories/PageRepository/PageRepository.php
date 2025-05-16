<?php

namespace App\Repositories\PageRepository;

use App\Models\Page;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class PageRepository extends BaseRepository implements PageRepositoryContact
{
    public function __construct(Page $model)
    {
        parent::__construct($model);
    }

    public function getAll(array $with = ['chapter']): Collection
    {
        return $this->model->with($with)->get();
    }

    public function findOrFail(int $id): Model
    {
        return $this->model->with(['chapter'])->findOrFail($id);
    }




}

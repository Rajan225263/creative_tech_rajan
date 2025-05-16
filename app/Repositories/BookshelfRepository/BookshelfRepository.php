<?php

namespace App\Repositories\BookshelfRepository;

use App\Models\Bookshelf;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BookshelfRepository extends BaseRepository implements BookshelfRepositoryContact
{
    public function __construct(Bookshelf $model)
    {
        parent::__construct($model);
    }

}

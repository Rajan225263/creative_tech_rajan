<?php

namespace App\Repositories\CategoryRepository;

use Illuminate\Database\Eloquent\Collection;

interface CategoryRepositoryContact
{
    public function getAll();
    public function find(int $id);
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
}

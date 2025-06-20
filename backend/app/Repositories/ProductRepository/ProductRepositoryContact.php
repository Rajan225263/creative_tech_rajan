<?php

namespace App\Repositories\ProductRepository;

use Illuminate\Database\Eloquent\Collection;

interface ProductRepositoryContact
{
    public function getAll();
    public function find(int $id);
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
}

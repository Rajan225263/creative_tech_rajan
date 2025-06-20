<?php

namespace App\Repositories\CategoryRepository;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CategoryRepository implements CategoryRepositoryContact
{
    protected $category;

    // Constructor injection
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function getAll()
    {
        return $this->category->all();
    }

    public function find(int $id)
    {
        return $this->category->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->category->create($data);
    }

    public function update(int $id, array $data)
    {
        $category = $this->category->findOrFail($id);
        $category->update($data);
        return $category;
    }

    public function delete(int $id)
    {
        $category = $this->category->findOrFail($id);
        $category->delete();
        return true;
    }

}

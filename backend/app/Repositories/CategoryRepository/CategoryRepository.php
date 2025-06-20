<?php

namespace App\Repositories\CategoryRepository;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CategoryRepository implements CategoryRepositoryContact
{
    public function getAll()
    {
        return Category::all();
    }

    public function find(int $id)
    {
        return Category::findOrFail($id);
    }

    public function create(array $data)
    {
        return Category::create($data);
    }

    public function update(int $id, array $data)
    {
        $category = Category::findOrFail($id);
        $category->update($data);
        return $category;
    }

    public function delete(int $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return true;
    }

}

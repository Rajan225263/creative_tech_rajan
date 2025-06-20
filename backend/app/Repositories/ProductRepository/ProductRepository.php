<?php

namespace App\Repositories\ProductRepository;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ProductRepository implements ProductRepositoryContact
{
    public function getAll()
    {
        return Product::with('categories')->get();
    }

    public function find(int $id)
    {
        return Product::with('categories')->findOrFail($id);
    }

    public function create(array $data)
    {
        $product = Product::create([
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'price' => $data['price'],
        ]);

        $product->categories()->sync($data['category_ids']);
        return $product->load('categories');
    }

    public function update(int $id, array $data)
    {
        $product = Product::findOrFail($id);
        $product->update($data);

        if (isset($data['category_ids'])) {
            $product->categories()->sync($data['category_ids']);
        }

        return $product->load('categories');
    }

    public function delete(int $id)
    {
        $product = Product::findOrFail($id);
        $product->categories()->detach();
        $product->delete();

        return true;
    }

}

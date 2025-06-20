<?php

namespace App\Repositories\ProductRepository;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ProductRepository implements ProductRepositoryContact
{
    protected $product;

    // Constructor injection
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getAll()
    {
        return $this->product->with('categories')->get();
    }

    public function find(int $id)
    {
        return $this->product->with('categories')->findOrFail($id);
    }

    public function create(array $data)
    {
        $product = $this->product->create([
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'price' => $data['price'],
        ]);

        $product->categories()->sync($data['category_ids']);
        return $product->load('categories');
    }

    public function update(int $id, array $data)
    {
        $product = $this->product->findOrFail($id);
        $product->update($data);

        if (isset($data['category_ids'])) {
            $product->categories()->sync($data['category_ids']);
        }

        return $product->load('categories');
    }

    public function delete(int $id)
    {
        $product = $this->product->findOrFail($id);
        $product->categories()->detach();
        $product->delete();

        return true;
    }

}

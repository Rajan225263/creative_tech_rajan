<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Repositories\ProductRepository\ProductRepositoryContact;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class ProductController extends Controller
{

    public function __construct()
    {

    }


    public function index(): JsonResponse
    {
        return response()->json(resolve(ProductRepositoryContact::class)->getAll());
    }


    public function store(ProductRequest $request): JsonResponse
    {
        try {

            $product = resolve(ProductRepositoryContact::class)->create($request->validated());

            return response()->json([
                'status' => true,
                'message' => 'Product created successfully.',
                'data' => $product,
            ], 201);

        } catch (\Exception $e) {
            \Log::error("Product creation failed: " . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to create product.',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function show($id): JsonResponse
    {
        try {
            $product = resolve(ProductRepositoryContact::class)->find($id);

            return response()->json([
                'status' => true,
                'message' => 'Product retrieved successfully.',
                'data' => $product
            ], 200);

        } catch (ModelNotFoundException  $e) {
            return response()->json([
                'status' => false,
                'message' => 'Product not found.',
            ], 404);

        } catch (\Exception $e) {
            \Log::error("Product fetch failed: " . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to retrieve product.',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function update(ProductRequest $request, $id): JsonResponse
    {
        try {
            $product = resolve(ProductRepositoryContact::class)->update($id, $request->validated());

            return response()->json([
                'status' => true,
                'message' => 'Product updated successfully.',
                'data' => $product,
            ], 200);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Product not found.',
            ], 404);

        } catch (\Exception $e) {
            \Log::error("Product update failed: " . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to update product.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            resolve(ProductRepositoryContact::class)->delete($id);

            return response()->json([
                'status' => true,
                'message' => 'Product deleted successfully.'
            ], 200);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Product not found.'
            ], 404);

        } catch (\Exception $e) {
            \Log::error("Product deletion failed: " . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to delete product.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}

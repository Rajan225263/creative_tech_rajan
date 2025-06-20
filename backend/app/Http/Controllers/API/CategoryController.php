<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Repositories\CategoryRepository\CategoryRepositoryContact;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class CategoryController extends Controller
{

    public function __construct()
    {

    }

    public function index(): JsonResponse
    {
        return response()->json(resolve(CategoryRepositoryContact::class)->getAll());
    }


    public function store(CategoryRequest $request): JsonResponse
    {
        try {

            $category = resolve(CategoryRepositoryContact::class)->create($request->validated());

            return response()->json([
                'status' => true,
                'message' => 'Category created successfully.',
                'data' => $category,
            ], 201);

        } catch (\Exception $e) {
            \Log::error("Category creation failed: " . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to create category.',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function show($id): JsonResponse
    {
        try {
            $category = resolve(CategoryRepositoryContact::class)->find($id);

            return response()->json([
                'status' => true,
                'message' => 'Category retrieved successfully.',
                'data' => $category
            ], 200);

        } catch (ModelNotFoundException  $e) {
            return response()->json([
                'status' => false,
                'message' => 'Category not found.',
            ], 404);

        } catch (\Exception $e) {
            \Log::error("Category fetch failed: " . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to retrieve category.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(CategoryRequest $request, $id): JsonResponse
    {
        try {
            $category = resolve(CategoryRepositoryContact::class)->update($id, $request->validated());

            return response()->json([
                'status' => true,
                'message' => 'Category updated successfully.',
                'data' => $category,
            ], 200);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Category not found.',
            ], 404);

        } catch (\Exception $e) {
            \Log::error("Category update failed: " . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to update category.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            resolve(CategoryRepositoryContact::class)->delete($id);

            return response()->json([
                'status' => true,
                'message' => 'Category deleted successfully.'
            ], 200);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Category not found.'
            ], 404);

        } catch (\Exception $e) {
            \Log::error("Category deletion failed: " . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to delete category.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}



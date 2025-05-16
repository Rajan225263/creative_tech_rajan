<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageRequest;
use App\Repositories\PageRepository\PageRepositoryContact;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class PageController extends Controller
{
    /**
     * Inject PageRepositoryContact
     */

    public function __construct()
    {

    }

    /**
     * List all pages
     */

    public function index(): JsonResponse
    {
        return response()->json(resolve(PageRepositoryContact::class)->getAll());
    }

    /**
     * Create a new page
     */

    public function store(PageRequest $request): JsonResponse
    {
        try {
            $page = resolve(PageRepositoryContact::class)->create($request->validated());

            return response()->json([
                'status' => true,
                'message' => 'Page created successfully.',
                'data' => $page,
            ], 201);

        } catch (\Exception $e) {
            \Log::error("Page creation failed: " . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to create page.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show a single page by ID using findOrFail
     */

    public function show($id): JsonResponse
    {
        try {
            $page = resolve(PageRepositoryContact::class)->findOrFail($id);

            return response()->json([
                'status' => true,
                'message' => 'Page retrieved successfully.',
                'data' => $page
            ], 200);

        } catch (ModelNotFoundException  $e) {
            return response()->json([
                'status' => false,
                'message' => 'Page not found.',
            ], 404);

        } catch (\Exception $e) {
            \Log::error("Book fetch failed: " . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to retrieve page.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update an existing page by ID.
     */

    public function update(PageRequest $request, $id): JsonResponse
    {
        try {
            $page = resolve(PageRepositoryContact::class)->update($id, $request->validated());

            return response()->json([
                'status' => true,
                'message' => 'Page updated successfully.',
                'data' => $page,
            ], 200);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Page not found.',
            ], 404);

        } catch (\Exception $e) {
            \Log::error("Page update failed: " . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to update page.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete a page by ID
     */

    public function destroy($id): JsonResponse
    {
        try {
            resolve(PageRepositoryContact::class)->delete($id);

            return response()->json([
                'status' => true,
                'message' => 'Page deleted successfully.'
            ], 200);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Page not found.'
            ], 404);

        } catch (\Exception $e) {
            \Log::error("Page deletion failed: " . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to delete page.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}



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

    /**
     * @OA\Get(
     *     path="/api/pages",
     *     summary="Get all pages",
     *     tags={"Pages"},
     *     security={{"ApiTokenAuth":{}}},
     *     @OA\Response(response=200, description="List of pages")
     * )
     */

    public function index(): JsonResponse
    {
        return response()->json(resolve(PageRepositoryContact::class)->getAll());
    }

    /**
     * Create a new page
     */

    /**
     * @OA\Post(
     *     path="/api/pages",
     *     summary="Create a new page",
     *     tags={"Pages"},
     *     security={{"ApiTokenAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"page_number", "content", "chapter_id"},
     *             @OA\Property(property="page_number", type="integer", example=1),
     *             @OA\Property(property="content", type="string", example="Page content goes here..."),
     *             @OA\Property(property="chapter_id", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response(response=201, description="Page created")
     * )
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

    /**
     * @OA\Get(
     *     path="/api/pages/{id}",
     *     summary="Get a page by ID",
     *     tags={"Pages"},
     *     security={{"ApiTokenAuth":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Page details")
     * )
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

    /**
     * @OA\Put(
     *     path="/api/pages/{id}",
     *     summary="Update a page",
     *     tags={"Pages"},
     *     security={{"ApiTokenAuth":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="page_number", type="integer", example=1),
     *             @OA\Property(property="content", type="string", example="Updated content"),
     *             @OA\Property(property="chapter_id", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response(response=200, description="Page updated")
     * )
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


    /**
     * @OA\Delete(
     *     path="/api/pages/{id}",
     *     summary="Delete a page",
     *     tags={"Pages"},
     *     security={{"ApiTokenAuth":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=204, description="Page deleted")
     * )
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



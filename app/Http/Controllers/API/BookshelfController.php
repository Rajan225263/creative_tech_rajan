<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookshelfRequest;
use App\Repositories\BookshelfRepository\BookshelfRepositoryContact;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * @OA\SecurityScheme(
 *     securityScheme="ApiTokenAuth",
 *     type="apiKey",
 *     in="header",
 *     name="X-API-TOKEN",
 *     description="Token based authentication using X-API-TOKEN header"
 * )
 */

class BookshelfController extends Controller
{
    /**
     * Inject BookshelfRepositoryContact
     */

    public function __construct(private BookshelfRepositoryContact $bookshelfRepo)
    {

    }

    /**
     * List all bookshelves
     */

    /**
     * @OA\Get(
     *     path="/api/bookshelves",
     *     summary="Get list of bookshelves",
     *     tags={"Bookshelves"},
     *     security={{"ApiTokenAuth":{}}},
     *     @OA\Response(response=200, description="Success")
     * )
 */

    public function index(): JsonResponse
    {
        return response()->json($this->bookshelfRepo->getAll());
    }

    /**
     * Create a new bookshelf
     */

    /**
     * @OA\Post(
     *     path="/api/bookshelves",
     *     summary="Create a new bookshelf",
     *     tags={"Bookshelves"},
     *      security={{"ApiTokenAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "location"},
     *             @OA\Property(property="name", type="string", example="Test"),
     *             @OA\Property(property="location", type="string", example="Test")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Bookshelf created")
     * )
     */

    public function store(BookshelfRequest $request): JsonResponse
    {
        try {
            $bookshelf = $this->bookshelfRepo->create($request->validated());

            return response()->json([
                'status' => true,
                'message' => 'Bookshelf created successfully.',
                'data' => $bookshelf,
            ], 201);

        } catch (\Exception $e) {
            \Log::error("Bookshelf creation failed: " . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to create bookshelf.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show a single bookshelf by ID using findOrFail
     */

    /**
     * @OA\Get(
     *     path="/api/bookshelves/{id}",
     *     summary="Get a single bookshelf",
     *     tags={"Bookshelves"},
     *      security={{"ApiTokenAuth":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Bookshelf details")
     * )
     */

    public function show($id): JsonResponse
    {
        try {
            $bookshelf = $this->bookshelfRepo->findOrFail($id);

            return response()->json([
                'status' => true,
                'message' => 'Bookshelf retrieved successfully.',
                'data' => $bookshelf
            ], 200);

        } catch (ModelNotFoundException  $e) {
            return response()->json([
                'status' => false,
                'message' => 'Bookshelf not found.',
            ], 404);

        } catch (\Exception $e) {
            \Log::error("Bookshelf fetch failed: " . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to retrieve bookshelf.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update an existing bookshelf by ID.
     */

    /**
     * @OA\Put(
     *     path="/api/bookshelves/{id}",
     *     summary="Update a bookshelf",
     *     tags={"Bookshelves"},
     *     security={{"ApiTokenAuth":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="Test"),
     *             @OA\Property(property="location", type="string", example="Test")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Bookshelf updated")
     * )
     */


    public function update(BookshelfRequest $request, $id): JsonResponse
    {
        try {
            $bookshelf = $this->bookshelfRepo->update($id, $request->validated());

            return response()->json([
                'status' => true,
                'message' => 'Bookshelf updated successfully.',
                'data' => $bookshelf,
            ], 200);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Bookshelf not found.',
            ], 404);

        } catch (\Exception $e) {
            \Log::error("Bookshelf update failed: " . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to update bookshelf.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete a bookshelf by ID
     */

    /**
     * @OA\Delete(
     *     path="/api/bookshelves/{id}",
     *     summary="Delete a bookshelf",
     *     tags={"Bookshelves"},
     *     security={{"ApiTokenAuth":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=204, description="Bookshelf deleted")
     * )
     */

    public function destroy($id): JsonResponse
    {
        try {
            $this->bookshelfRepo->delete($id);

            return response()->json([
                'status' => true,
                'message' => 'Bookshelf deleted successfully.'
            ], 200);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Bookshelf not found.'
            ], 404);

        } catch (\Exception $e) {
            \Log::error("Bookshelf deletion failed: " . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to delete bookshelf.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}



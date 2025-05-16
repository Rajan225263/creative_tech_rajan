<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Http\Requests\BookSearchRequest;
use App\Repositories\BookRepository\BookRepositoryContact;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class BookController extends Controller
{
    /**
     * Inject BookRepositoryContact
     */

    public function __construct()
    {

    }

    /**
     * List all books
     */

    /**
     * @OA\Get(
     *     path="/api/books",
     *     summary="Get all books",
     *     tags={"Books"},
     *     security={{"ApiTokenAuth":{}}},
     *     @OA\Response(response=200, description="List of books")
     * )
     */

    public function index(): JsonResponse
    {
        return response()->json(resolve(BookRepositoryContact::class)->getAll());
    }

    /**
     * Create a new book
     */

    /**
     * @OA\Post(
     *     path="/api/books",
     *     summary="Create a new book",
     *     tags={"Books"},
     *     security={{"ApiTokenAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title", "author", "published_year", "bookshelf_id"},
     *             @OA\Property(property="title", type="string"),
     *             @OA\Property(property="author", type="string"),
     *             @OA\Property(property="published_year", type="integer"),
     *             @OA\Property(property="bookshelf_id", type="integer")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Book created")
     * )
     */

    public function store(BookRequest $request): JsonResponse
    {
        try {
            $book = resolve(BookRepositoryContact::class)->create($request->validated());

            return response()->json([
                'status' => true,
                'message' => 'Book created successfully.',
                'data' => $book,
            ], 201);

        } catch (\Exception $e) {
            \Log::error("Book creation failed: " . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to create book.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show a single book by ID using findOrFail
     */

    /**
     * @OA\Get(
     *     path="/api/books/{id}",
     *     summary="Get a single book",
     *     tags={"Books"},
     *     security={{"ApiTokenAuth":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Book details")
     * )
     */

    public function show($id): JsonResponse
    {
        try {
            $book = resolve(BookRepositoryContact::class)->findOrFail($id);

            return response()->json([
                'status' => true,
                'message' => 'Book retrieved successfully.',
                'data' => $book
            ], 200);

        } catch (ModelNotFoundException  $e) {
            return response()->json([
                'status' => false,
                'message' => 'Book not found.',
            ], 404);

        } catch (\Exception $e) {
            \Log::error("Book fetch failed: " . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to retrieve book.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update an existing book by ID.
     */

    /**
     * @OA\Put(
     *     path="/api/books/{id}",
     *     summary="Update a book",
     *     tags={"Books"},
     *     security={{"ApiTokenAuth":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             @OA\Property(property="title", type="string"),
     *             @OA\Property(property="author", type="string"),
     *             @OA\Property(property="published_year", type="integer"),
     *             @OA\Property(property="bookshelf_id", type="integer")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Book updated")
     * )
     */

    public function update(BookRequest $request, $id): JsonResponse
    {
        try {
            $book = resolve(BookRepositoryContact::class)->update($id, $request->validated());

            return response()->json([
                'status' => true,
                'message' => 'Book updated successfully.',
                'data' => $book,
            ], 200);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Book not found.',
            ], 404);

        } catch (\Exception $e) {
            \Log::error("Book update failed: " . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to update bookshelf.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete a book by ID
     */

    /**
     * @OA\Delete(
     *     path="/api/books/{id}",
     *     summary="Delete a book",
     *     tags={"Books"},
     *     security={{"ApiTokenAuth":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=204, description="Book deleted")
     * )
     */

    public function destroy($id): JsonResponse
    {
        try {
            resolve(BookRepositoryContact::class)->delete($id);

            return response()->json([
                'status' => true,
                'message' => 'Book deleted successfully.'
            ], 200);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Book not found.'
            ], 404);

        } catch (\Exception $e) {
            \Log::error("Book deletion failed: " . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to delete book.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/books/search",
     *     summary="Search for books",
     *     tags={"Books"},
     *     security={{"ApiTokenAuth":{}}},
     *     @OA\Parameter(
     *         name="query",
     *         in="query",
     *         required=true,
     *         description="The search keyword for books",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(response=200, description="Search results")
     * )
     */

    public function search(BookSearchRequest $request)
    {
        $results = resolve(BookRepositoryContact::class)->search($request->query('query'));
        return response()->json($results);
    }

}



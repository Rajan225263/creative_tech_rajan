<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChapterRequest;
use App\Repositories\ChapterRepository\ChapterRepositoryContact;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class ChapterController extends Controller
{
    /**
     * Inject ChapterRepositoryContact
     */

    public function __construct()
    {

    }

    /**
     * List all chapters
     */

    public function index(): JsonResponse
    {
        return response()->json(resolve(ChapterRepositoryContact::class)->getAll());
    }

    /**
     * Create a new chapter
     */

    public function store(ChapterRequest $request): JsonResponse
    {
        try {
            $chapter = resolve(ChapterRepositoryContact::class)->create($request->validated());

            return response()->json([
                'status' => true,
                'message' => 'Chapter created successfully.',
                'data' => $chapter,
            ], 201);

        } catch (\Exception $e) {
            \Log::error("Chapter creation failed: " . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to create chapter.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show a single chapter by ID using findOrFail
     */

    public function show($id): JsonResponse
    {
        try {
            $chapter = resolve(ChapterRepositoryContact::class)->findOrFail($id);

            return response()->json([
                'status' => true,
                'message' => 'Chapter retrieved successfully.',
                'data' => $chapter
            ], 200);

        } catch (ModelNotFoundException  $e) {
            return response()->json([
                'status' => false,
                'message' => 'Chapter not found.',
            ], 404);

        } catch (\Exception $e) {
            \Log::error("Chapter fetch failed: " . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to retrieve chapter.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update an existing chapter by ID.
     */

    public function update(ChapterRequest $request, $id): JsonResponse
    {
        try {
            $chapter = resolve(ChapterRepositoryContact::class)->update($id, $request->validated());

            return response()->json([
                'status' => true,
                'message' => 'Chapter updated successfully.',
                'data' => $chapter,
            ], 200);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Book not found.',
            ], 404);

        } catch (\Exception $e) {
            \Log::error("Chapter update failed: " . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to update chapter.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete a chapter by ID
     */

    public function destroy($id): JsonResponse
    {
        try {
            resolve(ChapterRepositoryContact::class)->delete($id);

            return response()->json([
                'status' => true,
                'message' => 'Chapter deleted successfully.'
            ], 200);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Chapter not found.'
            ], 404);

        } catch (\Exception $e) {
            \Log::error("Chapter deletion failed: " . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to delete chapter.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function fullContent(int $chapterId)
    {
        $content = resolve(ChapterRepositoryContact::class)->getFullContent($chapterId);

        return response()->json([
            'chapter_id' => $chapterId,
            'full_content' => $content,
        ]);
    }


}



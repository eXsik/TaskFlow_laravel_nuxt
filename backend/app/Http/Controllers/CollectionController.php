<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCollectionRequest;
use App\Http\Requests\UpdateCollectionRequest;
use App\Models\Collection;
use App\Services\CollectionService;
use Illuminate\Http\JsonResponse;

class CollectionController extends Controller
{

    protected $collectionService;

    public function __construct(CollectionService $collectionService)
    {
        $this->collectionService = $collectionService;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCollectionRequest $request): JsonResponse
    {
        $collection = $this->collectionService->createCollection($request);

        if ($collection) {
            return response()->json($collection, 201);
        }

        return response()->json([
            'message' => 'Board not found or user is not authorized'
        ], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCollectionRequest $request, Collection $collection): JsonResponse
    {
        $updateCollection = $this->collectionService->updateCollection($request, $collection);

        if ($updateCollection) {
            return response()->json($updateCollection, 201);
        }

        return response()->json([
            'message' => 'Unauthorized'
        ], 403);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Collection $collection): JsonResponse
    {
        $this->collectionService->deleteCollection($collection);

        return response()->json(["message" => "Collection deleted successfully!"], 204);
    }
}

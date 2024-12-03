<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCardRequest;
use App\Http\Requests\UpdateCardRequest;
use App\Models\Card;
use App\Services\CardService;
use Illuminate\Http\JsonResponse;

class CardController extends Controller
{
    protected $cardService;

    public function __construct(CardService $cardService)
    {
        $this->cardService = $cardService;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCardRequest $request): JsonResponse
    {
        $card = $this->cardService->createCard($request);

        if ($card) {
            return response()->json($card, 201);
        }

        return response()->json([
            'message' => 'Board not found or user is not authorized'
        ], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCardRequest $request, Card $card): JsonResponse
    {
        $updateCard = $this->cardService->updateCard($request, $card);

        if ($updateCard) {
            return response()->json($updateCard, 201);
        }

        return response()->json([
            'message' => 'Unauthorized'
        ], 403);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Card $card): JsonResponse
    {
        $this->cardService->deleteCard($card);

        return response()->json(["message" => "Card deleted successfully!"], 204);
    }
}

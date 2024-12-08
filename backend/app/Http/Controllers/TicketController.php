<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use App\Http\Resources\TicketResource;
use App\Models\Card;
use App\Models\Ticket;
use App\Services\TicketService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TicketController extends Controller
{
    protected $ticketService;
    public function __construct(TicketService $ticketService)
    {
        $this->ticketService = $ticketService;
    }
    // /**
    //  * Display a listing of the resource.
    //  */
    // public function index()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketRequest $request, Card $card)
    {
        $validated = $request->validated();

        $selectedCard = Card::findOrFail($card->id);

        $ticket = Ticket::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'card_id' => $selectedCard->id,
            'owner_id' => $request->user()->id
        ]);

        return response()->json($ticket, 201);

    }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(Card $card)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, Card $card)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(Card $card)
    // {
    //     //
    // }

    public function getTicketsByCard(Card $card): JsonResponse|AnonymousResourceCollection
    {
        $tickets = $this->ticketService->getTicketsByCard($card);

        if (!$tickets) {
            return response()->json(['error' => 'Card not found.'], 404);
        }

        return $tickets;
    }
}

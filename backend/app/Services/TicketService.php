<?php
namespace App\Services;


use App\Http\Resources\TicketResource;
use App\Models\Card;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TicketService
{
  public function getTicketsByCard(Card $card): AnonymousResourceCollection|null
  {
    $selectedCard = Card::with("tickets")->findOrFail($card->id);

    if (!$selectedCard) {
      return null;
    }

    return TicketResource::collection($selectedCard->tickets);
  }
}
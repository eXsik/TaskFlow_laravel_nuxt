<?php
namespace App\Services;

use App\Http\Requests\StoreCardRequest;
use App\Http\Requests\UpdateCardRequest;
use App\Models\Board;
use App\Models\Card;
use Illuminate\Support\Facades\Gate;

class CardService
{
  public function createCard(StoreCardRequest $request): Card|null
  {
    $data = $request->validated();
    $user = $request->user();

    $card = Card::create([
      'name' => $data['name'],
      'board_id' => $data['board_id'],
      'owner_id' => $user->id
    ]);

    $board = Board::where('id', $data['board_id'])
      ->where('owner_id', $user->id)
      ->first();

    if ($board) {
      $board->cards()->attach($card->id);

      return $card;
    }

    return null;
  }

  public function updateCard(UpdateCardRequest $request, Card $card): Card
  {
    Gate::authorize('modify', arguments: $card);

    $data = $request->validated();

    $card->update($data);

    return $card;
  }

  public function deleteCard(Card $card): void
  {
    Gate::authorize('modify', $card);

    $card->delete();
  }
}
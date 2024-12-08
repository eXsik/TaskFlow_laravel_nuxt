<?php
namespace App\Services;

use App\Http\Requests\StoreBoardRequest;
use App\Models\Board;
use App\Models\Card;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class BoardService
{
  public function getUserBoards()
  {
    /** @var \App\Models\User */
    $currentUser = Auth::user();

    return $currentUser->boards()->with('cards')->get();
  }

  public function createBoard(StoreBoardRequest $request): Board
  {
    $validated = $request->validated();

    return Board::create([
      'owner_id' => Auth::id(),
      'name' => $validated['name'],
      'image' => $validated['image'] ?? null,
      'description' => $validated['description'] ?? null,
    ]);
  }

  public function showBoard(string $boardId)
  {
    $board = Board::where('id', $boardId)
      ->where('owner_id', Auth::id())
      ->with('cards')
      ->firstOrFail();

    return $board;
  }

  public function updateBoard(StoreBoardRequest $request, Board $board): Board
  {
    Gate::authorize('modify', $board);

    $validated = $request->validated();

    if (isset($validated['cards'])) {
      $newCardOrder = $validated['cards'];

      // Update order of cards
      foreach ($newCardOrder as $index => $cardId) {
        $card = Card::find($cardId);

        if ($card) {
          $card->update(['order' => $index]);
        }
      }
    }

    $board->update($validated);

    return $board;
  }

  public function deleteBoard(Board $board)
  {
    Gate::authorize('modify', $board);

    $board->delete();
  }
}
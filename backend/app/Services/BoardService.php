<?php
namespace App\Services;

use App\Http\Requests\StoreBoardRequest;
use App\Models\Board;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class BoardService
{
  public function getUserBoards()
  {
    return Auth::user()->boards;
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

  public function updateBoard(StoreBoardRequest $request, Board $board): Board
  {
    Gate::authorize('modify', $board);

    $validated = $request->validated();

    $board->update($validated);

    return $board;
  }

  public function deleteBoard(Board $board)
  {
    Gate::authorize('modify', $board);

    $board->delete();
  }
}
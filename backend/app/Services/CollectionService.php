<?php
namespace App\Services;

use App\Http\Requests\StoreCollectionRequest;
use App\Http\Requests\UpdateCollectionRequest;
use App\Models\Board;
use App\Models\Collection;
use Illuminate\Support\Facades\Gate;

class CollectionService
{
  public function createCollection(StoreCollectionRequest $request): Collection|null
  {
    $data = $request->validated();
    $user = $request->user();

    $collection = Collection::create([
      'name' => $data['name'],
      'board_id' => $data['board'],
      'owner_id' => $user->id
    ]);

    $board = Board::where('id', $data['board'])
      ->where('owner_id', $user->id)
      ->first();

    if ($board) {
      $board->collection()->attach($collection->id);

      return $collection;
    }

    return null;
  }

  public function updateCollection(UpdateCollectionRequest $request, Collection $collection): Collection
  {
    Gate::authorize('modify', $collection);

    $data = $request->validated();

    $collection->update($data);

    return $collection;
  }

  public function deleteCollection(Collection $collection): void
  {
    Gate::authorize('modify', $collection);

    $collection->delete();
  }
}
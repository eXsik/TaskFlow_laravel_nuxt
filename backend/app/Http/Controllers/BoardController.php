<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBoardRequest;
use App\Http\Resources\BoardResource;
use App\Models\Board;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): ResourceCollection
    {
        $boards = Auth::user()->boards;

        return BoardResource::collection($boards);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBoardRequest $request): BoardResource
    {
        $validated = $request->validated();

        $board = Board::create([
            'owner_id' => Auth::id(),
            'name' => $validated['name'],
            'description' => $validated['description'],
        ]);

        return new BoardResource($board);
    }

    /**
     * Display the specified resource.
     */
    public function show(Board $board)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Board $board)
    {
        //
    }

    /**
     * Update the given board..
     * 
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(StoreBoardRequest $request, Board $board): BoardResource
    {
        // Gate::authorize('update', $board);

        $validated = $request->validated();

        $board->update([
            'name' => $validated['name'],
            'description' => $validated['description']
        ]);

        return new BoardResource($board);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Board $board)
    {
        //
    }
}

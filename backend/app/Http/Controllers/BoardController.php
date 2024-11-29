<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBoardRequest;
use App\Http\Resources\BoardResource;
use App\Models\Board;
use App\Services\BoardService;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BoardController extends Controller
{
    protected $boardService;

    public function __construct(BoardService $boardService)
    {
        $this->boardService = $boardService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): ResourceCollection
    {
        $boards = $this->boardService->getUserBoards();

        return BoardResource::collection($boards);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBoardRequest $request): BoardResource
    {
        $board = $this->boardService->createBoard($request);

        return new BoardResource($board);
    }

    /**
     * Update the given board.
     * 
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(StoreBoardRequest $request, Board $board): BoardResource
    {
        $updatedBoard = $this->boardService->updateBoard($request, $board);

        return new BoardResource($updatedBoard);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Board $board)
    {
        $this->boardService->deleteBoard($board);

        return response()->json(["message" => "Board deleted successfully!"], 204);
    }
}

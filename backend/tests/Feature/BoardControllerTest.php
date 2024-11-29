<?php

namespace Tests\Feature;

use App\Http\Requests\StoreBoardRequest;
use App\Models\Board;
use App\Models\User;
use App\Services\BoardService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BoardControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $boardServiceMock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->boardServiceMock = $this->mock(BoardService::class);
    }

    /**
     * Testing if user gets all boards that are assigned to him.
     */
    public function test_can_get_boards(): void
    {
        $boards = Board::factory()->count(3)->create(['owner_id' => $this->user->id]);

        $this->boardServiceMock->shouldReceive('getUserBoards')->once()->andReturn($boards);

        $this->actingAs($this->user);

        $response = $this->getJson(route('boards.index'));

        $response->assertOk()->assertJsonCount(3);
    }

    /**
     * Testing if user can create a board.
     */
    public function test_can_create_board(): void
    {
        $board = new Board([
            'name' => 'Test Board',
            'description' => 'This is a test board.',
        ]);
        $createdAt = now()->toDateTimeString();
        $updatedAt = now()->toDateTimeString();

        $board->created_at = $createdAt;
        $board->updated_at = $updatedAt;

        $this->boardServiceMock
            ->shouldReceive('createBoard')
            ->with($this->isInstanceOf(StoreBoardRequest::class))
            ->andReturn($board);

        $this->actingAs($this->user);

        $response = $this->postJson(route('boards.store'), $board->toArray());

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'name' => 'Test Board',
            'description' => 'This is a test board.',
            'created_at' => $createdAt,
            'updated_at' => $updatedAt
        ]);
    }

    /**
     * Testing if user can update a board.
     */
    public function test_can_update_board(): void
    {
        $board = Board::factory()->create(['owner_id' => $this->user->id]);

        $updatedBoardData = [
            'name' => 'Updated Board Name',
            'description' => 'Updated description of the board.',
        ];

        $this->boardServiceMock
            ->shouldReceive('updateBoard')
            ->with($this->isInstanceOf(StoreBoardRequest::class), $this->isInstanceOf(Board::class))
            ->andReturnUsing(function ($request, $board) use ($updatedBoardData) {
                $board->name = $updatedBoardData['name'];
                $board->description = $updatedBoardData['description'];
                $board->save();

                return $board;
            });

        $this->actingAs($this->user);

        $response = $this->putJson(route('boards.update', $board->id), $updatedBoardData);

        $response->assertStatus(200);
        $response->assertJsonFragment($updatedBoardData);
    }

    /**
     * Testing if user can delete a board.
     */
    public function test_can_delete_board(): void
    {
        $board = Board::factory()->create(['owner_id' => $this->user->id]);

        $this->boardServiceMock
            ->shouldReceive('deleteBoard')
            ->with($this->isInstanceOf(Board::class));

        $this->actingAs($this->user);

        $response = $this->deleteJson(route('boards.destroy', $board), );

        $response->assertStatus(204);
    }
}

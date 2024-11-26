<?php

namespace Tests\Feature;

use App\Models\Board;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BoardRelationshipTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test to check if user can have many boards.
     */
    public function test_a_user_can_have_many_boards(): void
    {
        $user = User::factory()->create();

        $board1 = Board::factory()->create(['name' => 'Board 1', 'owner_id' => $user->id]);
        $board2 = Board::factory()->create(['name' => 'Board 2', 'owner_id' => $user->id]);

        $this->assertCount(2, $user->boards);
        $this->assertTrue($user->boards->contains($board1));
        $this->assertTrue($user->boards->contains($board2));
    }

    /**
     * Test to check if a board belongs to a user.
     */
    public function test_a_board_belongs_to_a_user(): void
    {
        $user = User::factory()->create();
        $board = Board::factory()->create(['name' => 'Board 1', 'owner_id' => $user->id]);

        $this->assertEquals($user->id, $board->owner->id);

    }
}

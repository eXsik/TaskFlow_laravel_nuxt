<?php

namespace Tests\Feature;

use App\Http\Requests\StoreCardRequest;
use App\Models\Board;
use App\Models\Card;
use App\Models\User;
use App\Services\CardService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class CardControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $cardServiceMock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->cardServiceMock = $this->mock(CardService::class);
        $this->app->instance(CardService::class, $this->cardServiceMock);
    }

    /**
     * Testing if user can create a card.
     */
    public function test_can_create_card(): void
    {
        $board = Board::factory()->create();

        $data = [
            'name' => 'New Card',
            'board_id' => $board->id,
            'owner_id' => $this->user->id
        ];

        $this->cardServiceMock->shouldReceive('createCard')
            ->with($this->isInstanceOf(StoreCardRequest::class))
            ->andReturn(new Card([
                'name' => $data['name'],
                'board_id' => $data['board_id'],
                'owner_id' => $this->user->id,
            ]));

        $response = $this->actingAs($this->user)->postJson(route('cards.store'), $data);

        $response->assertStatus(201)->assertJson([
            'name' => 'New Card',
            'board_id' => $board->id,
            'owner_id' => $this->user->id
        ]);

    }
}

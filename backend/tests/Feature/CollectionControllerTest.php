<?php

namespace Tests\Feature;

use App\Models\Board;
use App\Models\Collection;
use App\Models\User;
use App\Services\CollectionService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class CollectionControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $collectionServiceMock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->collectionServiceMock = $this->mock(CollectionService::class);
        $this->app->instance(CollectionService::class, $this->collectionServiceMock);
    }

    /**
     * Testing if user can create a collection.
     */
    public function test_can_create_collection(): void
    {
        $board = Board::factory()->create();

        $data = [
            'name' => 'New Collection',
            'board_id' => $board->id
        ];

        $this->collectionServiceMock->shouldReceive('createCollection')
            ->once()
            ->with(Mockery::type('array'))
            ->andReturn(new Collection([
                'name' => $data['name'],
                'board_id' => $data['board_id'],
                'owner_id' => $this->user->id,
            ]));

        $response = $this->actingAs($this->user)->postJson(route('collections.store'), $data);

        $response->assertStatus(201)->assertJson([
            'name' => 'New Collection',
            'board_id' => $board->id,
        ]);
    }
}

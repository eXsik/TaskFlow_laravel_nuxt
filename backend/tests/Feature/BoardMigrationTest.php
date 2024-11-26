<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class BoardMigrationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_it_creates_boards_table_with_owner_id(): void
    {
        $this->artisan('migrate');

        $this->assertTrue(Schema::hasTable('boards'));
        $this->assertTrue(Schema::hasColumn('boards', 'owner_id'));
    }
}

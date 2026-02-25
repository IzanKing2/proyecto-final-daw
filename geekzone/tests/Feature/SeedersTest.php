<?php

namespace Tests\Unit;

use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SeedersTest extends TestCase
{
    use RefreshDatabase; // Limpia TODO automáticamente

    /**
     * A basic test example.
     */
    public function test_seeder_create_without_errors(): void
    {
        $this->seed(DatabaseSeeder::class);
        $this->assertTrue(true);
    }
}

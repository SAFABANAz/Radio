<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_users_index_endpoint_is_available(): void
    {
        $response = $this->getJson('/api/v1/users');

        $response->assertStatus(200);
    }
}

<?php

namespace Tests\Feature;

use Tests\TestCase;

class AuthenticationValidationTest extends TestCase
{
    public function test_register_validation_rejects_invalid_mobile_and_email(): void
    {
        $response = $this->postJson('/api/v1/auth/register', [
            'full_name' => 'Ali Rezaei',
            'mobile' => '1234567890',
            'email' => 'not-an-email',
            'password' => '1234',
            'password_confirmation' => '1234',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['mobile', 'email', 'password']);
    }

    public function test_login_validation_requires_iranian_mobile_format(): void
    {
        $response = $this->postJson('/api/v1/auth/login', [
            'mobile' => '1234567890',
            'password' => '12345678',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['mobile']);
    }
}

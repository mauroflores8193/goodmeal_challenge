<?php

namespace Tests\Feature;

use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;
use App\Models\User;

class AuthTest extends TestCase {

    public function setUp(): void {
        parent::setUp();
        $this->newUer = User::factory()->create();
    }

    public function test_login_ok() {
        $response = $this->postJson('/api/login', ['email' => $this->newUer->email, 'password' => 'password']);
        $response->assertOk();
    }

    public function test_login_password_failed() {
        $response = $this->postJson('/api/login', ['email' => $this->newUer->email, 'password' => 'fail']);
        $response->assertUnauthorized();
    }

    public function test_login_email_failed() {
        $email_failed = 'fail@gmail.com';
        $response = $this->postJson('/api/login', ['email' => $email_failed, 'password' => 'password']);
        $response->assertUnauthorized();
    }

    public function test_me() {
        $user = $this->newUer;
        $response = $this->actingAs($user)->get('/api/admin/me');
        $response
            ->assertOk()
            ->assertJson(function (AssertableJson $json) use ($user) {
                $json->where('name', $user->name)
                    ->where('email', $user->email)
                    ->etc();
            });
    }
}

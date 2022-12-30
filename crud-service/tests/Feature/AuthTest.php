<?php

namespace Tests\Feature;

use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;
use App\Models\User;

class AuthTest extends TestCase {

    public function test_login_ok() {
        $user = User::all()->first();
        $response = $this->postJson('/api/login', ['email' => $user->email, 'password' => 'password']);
        $response->assertOk();
    }

    public function test_login_password_failed() {
        $user = User::all()->first();
        $response = $this->postJson('/api/login', ['email' => $user->email, 'password' => 'fail']);
        $response->assertUnauthorized();
    }

    public function test_login_email_failed() {
        $email_failed = 'fail@gmail.com';
        $response = $this->postJson('/api/login', ['email' => $email_failed, 'password' => 'password']);
        $response->assertUnauthorized();
    }

    public function test_me() {
        $user = User::all()->first();
        $response = $this->actingAs($user)->get('/api/me');
        $response
            ->assertOk()
            ->assertJson(function (AssertableJson $json) use ($user) {
                $json->where('name', $user->name)
                    ->where('email', $user->email)
                    ->etc();
            });
    }
}

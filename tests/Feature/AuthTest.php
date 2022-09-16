<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function testLoginPageSuccess()
    {
        $response = $this->get(route('auth.login'));
        if (auth('web')->user()) {
            $response->assertNotFound();
        } else {
            $response->assertOk();
        }

    }

    public function testLoginSuccess()
    {

        User::factory()->create([
            'login' => 'bakhadyrovf',
            'password' => bcrypt(config('credentials.admin-password'))
        ]);

        $data = [
            'login' => 'bakhadyrovf',
            'password' => config('credentials.admin-password')
        ];

        $response = $this->post(route('auth.login-action'), $data);

        $response->assertRedirect(route('warehouses.index'));
    }

    public function testInvalidLoginCredentials()
    {
        User::factory()->create([
            'login' => 'bakhadyrovf',
            'password' => bcrypt(config('credentials.admin-password'))
        ]);

        $invalidLoginResponse = $this->post(route('auth.login-action'), [
            'login' => 'bakhadyrov',
            'password' => config('credentials.admin-password')
        ]);

        $invalidLoginResponse->assertRedirect('/')
            ->assertStatus(302)
            ->assertSessionHasErrors('login');

        $invalidPasswordResponse = $this->post(route('auth.login-action'), [
            'login' => 'bakhadyrovf',
            'password' => config('credentials.admin-password') . 'test'
        ]);

        $invalidPasswordResponse->assertRedirect(route('auth.login'))
            ->assertStatus(302)
            ->assertSessionHasErrors('password');
    }
}

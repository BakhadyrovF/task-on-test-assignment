<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testLoginPageSuccess()
    {
        $response = $this->get(route('auth.login'));
        if (auth('web')->user()) {
            $response->assertNotFound();
        } else {
            $response->assertOk();
        }

    }

    public function testLoginActionSuccess()
    {
        $data = [
            'login' => 'bakhadyrovf',
            'password' => config('credentials.admin-password')
        ];

        $response = $this->post(route('auth.login-action'), $data);

        $response->assertRedirect(route('warehouses.index'));
    }

    public function testInvalidLoginCredentials()
    {
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

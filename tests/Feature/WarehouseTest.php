<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WarehouseTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAllPagesSuccess()
    {
        auth('web')->login(User::factory()->create());
        $response = $this->get(route('warehouses.index'));

        $response->assertStatus(200);
    }

}

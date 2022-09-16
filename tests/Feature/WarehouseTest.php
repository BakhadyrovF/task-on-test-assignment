<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WarehouseTest extends TestCase
{
    use RefreshDatabase;

    public function testAllPagesSuccess()
    {
        oneTimeLogin();

        $this->get(route('warehouses.index'))->assertOk();
        $warehouse = Warehouse::factory()->create();

        $this->get(route('warehouses.create', $warehouse))->assertOk();

    }

    public function testCreateSuccess()
    {
        oneTimeLogin();

        $data = [
            'title' => 'Some Warehouse',
            'code' => mt_rand(100, 10000)
        ];

        $this->post(route('warehouses.store'), $data)->assertRedirect(route('warehouses.index'));

        $this->assertDatabaseHas('warehouses', $data);
    }

    public function testCreateUnprocessableContent()
    {
        oneTimeLogin();

        $data = [
            'title' => 'Some warehouse',
            'code' => 1234567
        ];
        $firstWarehouse = Warehouse::factory()->create($data);

        $this->post(route('warehouses.store'), $data)->assertSessionHasErrors('code');

        $this->assertDatabaseMissing('warehouses', array_merge($data, ['id' => ++$firstWarehouse->id]));
    }

    public function testDeleteSuccess()
    {
        oneTimeLogin();

        $warehouse = Warehouse::factory()->create();

        $this->delete(route('warehouses.destroy', $warehouse))->assertRedirect(route('warehouses.index'));

        $this->assertDatabaseMissing('warehouses', ['id' => $warehouse->id]);
    }

    public function testDeleteNotFound()
    {
        oneTimeLogin();

        $this->delete(route('warehouses.destroy', 1))->assertNotFound();
    }
}

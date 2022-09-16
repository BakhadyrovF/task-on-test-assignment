<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function testAllPagesSuccess()
    {
        oneTimeLogin();

        $this->get(route('products.index'))->assertOk();
        $this->get(route('products.create'))->assertOk();

        $product = Product::factory()->create();
        $this->get(route('products.edit', $product))->assertOk();
    }

    public function testCreateSuccess()
    {
        oneTimeLogin();

        $warehouse = Warehouse::factory()->create();
        $data = [
            'title' => 'Some product',
            'manufacture_date' => now()->format('Y-m-d'),
            'warehouses' => [
                $warehouse->id => [
                    'price' => 225.10,
                    'amount' => 20
                ]
            ]
        ];

        $this->post(route('products.store'), $data)->assertRedirect(route('products.edit', 2));

        $this->assertDatabaseHas('products', ['id' => 2]);

        $this->refreshDatabase();
    }

    public function testCreateUnprocessableContent()
    {
        oneTimeLogin();

        $this->post(route('products.store'), [])->assertSessionHasErrors(['title', 'manufacture_date']);
    }

    public function testUpdateSuccess()
    {
        oneTimeLogin();

        $warehouse = Warehouse::factory()->create();
        $data = [
            'title' => 'Some new title',
            'manufacture_date' => now()->format('Y-m-d'),
            'warehouses' => [
                $warehouse->id => [
                    'price' => 225.10,
                    'amount' => 20
                ]
            ]
        ];

        $currentId = 3;
        $this->post(route('products.store'), $data)->assertRedirect(route('products.edit', $currentId));
        $this->assertDatabaseHas('products', ['id' => $currentId]);

        $data['title'] = 'Some updated title';
        $this->put(route('products.update', $currentId), $data)->assertRedirect(route('products.edit', $currentId));
        $this->assertDatabaseMissing('products', [
            'id' => $currentId,
            'title' => 'Some new title'
        ]);
        $this->assertDatabaseHas('products', [
            'id' => $currentId,
            'title' => 'Some updated title'
        ]);
    }


    public function testDeleteSuccess()
    {
        oneTimeLogin();

        $product = Product::factory()->create();

        $this->delete(route('products.destroy', $product))->assertOk();

        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }

    public function testDeleteNotFound()
    {
        oneTimeLogin();

        $this->delete(route('products.destroy', 99))->assertNotFound();
    }
}

<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'login' => 'bakhadyrovf',
            'password' => bcrypt(config('credentials.admin-password'))
        ]);

        Product::factory()->count(10)
            ->hasAttached(
                Warehouse::factory()->count(3),
                [
                    'price' => mt_rand(100, 1000000),
                    'amount' => mt_rand(1, 1000000)
                ]
            )->create();

        Product::factory()->count(5)->create();

    }
}

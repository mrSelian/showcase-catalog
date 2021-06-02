<?php

namespace Database\Seeders;

use App\Models\OrderModel;
use App\Models\ProductModel;
use App\Models\User;
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
        //create admin
        User::factory()->create([
            'name' => 'admin1',
            'email' => 'admin1@mysite.ru',
            'is_admin' => true,
        ]);

        ProductModel::factory(30)->create(['old_price' => 99999]);
        ProductModel::factory(20)->create();
        ProductModel::factory(20)->create(['deleted' => true]);
        OrderModel::factory(20)->create();
    }
}

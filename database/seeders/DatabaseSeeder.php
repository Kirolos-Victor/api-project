<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Transaction;
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

        \App\Models\User::factory(200)->create();
        \App\Models\Category::factory(5)->create();
        \App\Models\Product::factory(1000)->create();
        \App\Models\Transaction::factory(100)->create();
    }
}

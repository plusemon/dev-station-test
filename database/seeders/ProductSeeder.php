<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create some dummy products
        foreach (range(1, 5) as $num) {
            Product::query()->create([
                'title' => "Example Test Proudct {$num}",
                'price' => random_int(10, 150),
            ]);
        }
    }
}

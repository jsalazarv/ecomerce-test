<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $products = Product::factory()->count(100)->create();
        $pathToFile = storage_path('resources/placeholder.jpeg');

        foreach($products as $product){
            $product->addMedia($pathToFile)->preservingOriginal()->toMediaCollection('photos');
        }
    }
}

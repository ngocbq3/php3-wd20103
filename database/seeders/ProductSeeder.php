<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 1000; $i++) {
            DB::table('products')->insert([
                'name' => fake()->text(25),
                'price' => rand(5, 100),
                'quantity' => rand(1, 1000),
                'image' => fake()->imageUrl(),
                'description'   => fake()->paragraph(3),
                'category_id'   => rand(1, 3)
            ]);
        }
    }
}

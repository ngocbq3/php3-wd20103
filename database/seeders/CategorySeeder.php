<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['id' => 1, 'name' => 'Điện thoại'],
            ['id' => 2, 'name' => 'Máy tính'],
            ['id' => 3, 'name' => 'Đồng hồ thông minh']
        ]);
    }
}

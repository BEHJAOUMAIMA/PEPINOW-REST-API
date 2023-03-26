<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'category_name' => 'Tree',
        ]);
        Category::create([
            'category_name' => 'Flowers',
        ]);
        Category::create([
            'category_name' => 'Mushrooms',
        ]);
        Category::create([
            'category_name' => 'Vegetable plants',
        ]);
        Category::create([
            'category_name' => 'House plants',
        ]);
        Category::create([
            'category_name' => 'bushes',
        ]);
    }
}

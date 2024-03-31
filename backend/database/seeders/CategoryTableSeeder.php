<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       

        $categories = ['Bug Report', 'Bug Report', 'Improvement', 'Product Quality'];

        foreach ($categories as $category) {
            Category::create([
                'title' => $category,
            ]);
        }
    }
}

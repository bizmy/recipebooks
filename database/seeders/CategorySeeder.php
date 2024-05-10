<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use Illuminate\Support\Facades\Log;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Sweet dish', 'description' => 'Category related to Sweet dishes'],
            ['name' => 'Main dish', 'description' => 'Category related to Main dishes'],
            ['name' => 'Breakfast', 'description' => 'Category related to Breakfast'],
            ['name' => 'Snack', 'description' => 'Category related to Snacks'],
            ['name' => 'Sour dish', 'description' => 'Category related to Sour dishes'],
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert($category);
        }
    }
}

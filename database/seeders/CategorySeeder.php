<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\Log;

class CategorySeeder extends Seeder
{
    public function run()
    {
        try {
            Category::create(['name' => 'Sweet Dishes']);
            Category::create(['name' => 'Main Dishes']);
            Category::create(['name' => 'Snacks']);
            Category::create(['name' => 'Dinner Dishes']);
            Category::create(['name' => 'Breakfast Dishes']);
            
            // Add more categories as needed
            $this->command->info('Categories seeded successfully.');
        } catch (\Exception $e) {
            Log::error('Error seeding categories: ' . $e->getMessage());
            $this->command->error('Error seeding categories. Check the logs for more information.');
        }
    }
}

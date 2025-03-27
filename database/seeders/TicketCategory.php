<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketCategory extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Technical', 'is_active' => 1],
            ['name' => 'Billing', 'is_active' => 1],
            ['name' => 'General', 'is_active' => 1],
        ];

        foreach ($categories as $category) {
            if (!Categories::where('name', $category['name'])->exists()) {
                Categories::create($category);
            }
        }
    }
}

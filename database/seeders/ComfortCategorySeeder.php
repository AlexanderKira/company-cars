<?php

namespace Database\Seeders;

use App\Models\ComfortCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComfortCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (ComfortCategory::count() === 0) {
            ComfortCategory::factory()->count(4)->create();
        }
    }
}

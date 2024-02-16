<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            // [
            //     'name' => 'Elektronika',
            //     'description' => 'Opis glavne kategorije elektronika',
            //     'parent_id' => null,
            // ],
            [
                'name' => 'Huawei Nova 7',
                'description' => 'Elegantan pametni telefon s naprednim kamerama.',
                'price' => 649.99,
                'sku' => 'HUW-N7',
                'is_published' => true,
            ],
            [
                'name' => 'Huawei P50',
                'description' => 'Najnoviji model s vrhunskim zaslonom i kamerama.',
                'price' => 1099.99,
                'sku' => 'HUW-P50',
                'is_published' => true,
            ],
            [
                'name' => 'Huawei Y9 Prime',
                'description' => 'Pristupačan pametni telefon s velikim zaslonom.',
                'price' => 299.99,
                'sku' => 'HUW-Y9P',
                'is_published' => true,
            ],
        ];

        foreach ($categories as $categoryData) {
            Category::create($categoryData);
        }
    }
}

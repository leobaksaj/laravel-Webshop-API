<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = Category::find(13);

        if ($category) {
        
            $productIdsToAssociate = [29, 30, 31, 32, 33, 34];

            foreach ($productIdsToAssociate as $productId) {
                $product = Product::find($productId);

                if ($product) {
                    $product->categories()->attach($category->id);
                } else {
                    $this->command->info("Product with ID $productId does not exist.");
                }
            }

        } else {
            $this->command->info('Category with ID 13 does not exist.');
        }

        // $huaweiModels = [
        //     [
        //         'name' => 'Huawei P40',
        //         'description' => 'Elegantan pametni telefon s izvrsnom kamerom.',
        //         'price' => 799.99,
        //         'sku' => 'HUW-P40',
        //         'is_published' => true,
        //     ],
        //     [
        //         'name' => 'Huawei Mate 30 Pro',
        //         'description' => 'Premium pametni telefon s velikim zaslonom i snažnom baterijom.',
        //         'price' => 899.99,
        //         'sku' => 'HUW-M30P',
        //         'is_published' => true,
        //     ],
        //     [
        //         'name' => 'Huawei P30 Lite',
        //         'description' => 'Pristupačan pametni telefon s solidnim performansama.',
        //         'price' => 399.99,
        //         'sku' => 'HUW-P30L',
        //         'is_published' => true,
        //     ],
        //     // Dodajte još modela prema potrebi
        // ];

        // foreach ($huaweiModels as $model) {
        //     Product::create($model);
        // }

    }
}

<?php

namespace Database\Seeders;

use App\Models\PriceList;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PriceListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PriceList::create(['name' => 'Cjenik 1', 'price' => 20.99, 'sku' => 'SKU1']);
        PriceList::create(['name' => 'Cjenik 2', 'price' => 15.99, 'sku' => 'SKU2']);
        PriceList::create(['name' => 'Cjenik 3', 'price' => 120.99, 'sku' => 'SKU3']);
        PriceList::create(['name' => 'Cjenik 4', 'price' => 115.99, 'sku' => 'SKU4']);
        PriceList::create(['name' => 'Cjenik 5', 'price' => 50.99, 'sku' => 'SKU5']);
        PriceList::create(['name' => 'Cjenik 6', 'price' => 345.99, 'sku' => 'SKU6']);
        
    }
}

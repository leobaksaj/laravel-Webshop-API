<?php

namespace Database\Seeders;

use App\Models\ContractList;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContractListsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ContractList::create([
            'user_id'    => 1,
            'product_id' => 1,
            'price'      => 8.00,
            'sku'        => 'SKU-123',
        ]);

        ContractList::create([
            'user_id'    => 2,
            'product_id' => 2,
            'price'      => 10.00,
            'sku'        => 'SKU-456',
        ]);
    }
}

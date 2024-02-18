<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::create([
            'first_name' => 'Marko',
            'last_name' => 'Marić',
            'email' => 'marko@example.com',
            'phone_number' => '111222333',
            'address' => 'Ilica 3',
            'city' => 'Zagreb',
            'country' => 'Hrvatska',
        ]);
        
        Customer::create([
            'first_name' => 'Petra',
            'last_name' => 'Pavić',
            'email' => 'petra@example.com',
            'phone_number' => '444555666',
            'address' => 'Trg Republike 4',
            'city' => 'Osijek',
            'country' => 'Hrvatska',
        ]);
        
    }
}

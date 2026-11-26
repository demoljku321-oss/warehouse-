<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        $product = DB::table('products')->first();

        if (!$product) {
            $this->command->warn(
                'No product found. Run ProductSeeder first.'
            );
            return;
        }

        DB::table('customers')->updateOrInsert(
            ['email' => 'customer@example.com'],
            [
                'product_id' => $product->id,
                'name' => 'Demo Customer',
                'phone' => '9876543212',
                'address' => 'Ahmedabad, Gujarat',
                'message' => 'Demo customer record',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        $this->command->info('CustomerSeeder completed.');
    }
}

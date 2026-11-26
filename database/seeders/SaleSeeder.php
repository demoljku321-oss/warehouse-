<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SaleSeeder extends Seeder
{
    public function run(): void
    {
        $customer = DB::table('customers')->first();
        $product = DB::table('products')->first();

        if (!$customer || !$product) {
            $this->command->warn('Customer or product not found. SaleSeeder skipped.');
            return;
        }

        DB::table('sales')->updateOrInsert(
            ['invoice_number' => 'INV001'],
            [
                'customer_id' => $customer->id,
                'product_id' => $product->id,
                'customer_name' => $customer->name ?? 'Demo Customer',
                'customer_email' => $customer->email ?? 'customer@example.com',
                'customer_phone' => $customer->phone ?? '9876543212',
                'quantity' => 1,
                'unit_price' => 1000,
                'total_amount' => 1000,
                'status' => 'completed',
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PurchaseItemSeeder extends Seeder
{
    public function run(): void
    {
        $purchase = DB::table('purchases')
            ->where('bill_number', 'BILL001')
            ->first();

        $product = DB::table('products')->first();

        if (!$purchase || !$product) {
            $this->command->warn('Purchase or product not found. PurchaseItemSeeder skipped.');
            return;
        }

        DB::table('purchase_items')->updateOrInsert(
            [
                'purchase_id' => $purchase->id,
                'product_id' => $product->id,
            ],
            [
                'product_name' => $product->product_name,
                'product_code' => $product->product_code,
                'unit' => $product->unit,
                'quantity' => 5,
                'purchase_price' => 1000,
                'line_total' => 5000,
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );
    }
}   
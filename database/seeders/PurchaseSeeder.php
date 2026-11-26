<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PurchaseSeeder extends Seeder
{
    public function run(): void
    {
        $supplier = DB::table('suppliers')->first();

        if (!$supplier) {
            $this->command->warn('Supplier not found. PurchaseSeeder skipped.');
            return;
        }

        DB::table('purchases')->updateOrInsert(
            ['bill_number' => 'BILL001'],
            [
                'supplier_id' => $supplier->id,
                'purchase_date' => now()->toDateString(),
                'subtotal' => 5000,
                'grand_total' => 5000,
                'notes' => 'Demo purchase',
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );
    }
}
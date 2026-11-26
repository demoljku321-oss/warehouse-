<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        $suppliers = [
            [
                'supplier_code' => 'SUP001',
                'company_name' => 'ABC Suppliers',
                'contact_person' => 'Rahul Patel',
                'phone' => '9876543210',
                'email' => 'abc@warehouse.local',
                'address' => 'Main Market',
                'city' => 'Ahmedabad',
                'state' => 'Gujarat',
                'pincode' => '380001',
                'gst_number' => null,
                'status' => 'Active',
            ],
            [
                'supplier_code' => 'SUP002',
                'company_name' => 'XYZ Suppliers',
                'contact_person' => 'Amit Shah',
                'phone' => '9876543211',
                'email' => 'xyz@warehouse.local',
                'address' => 'Ring Road',
                'city' => 'Surat',
                'state' => 'Gujarat',
                'pincode' => '395002',
                'gst_number' => null,
                'status' => 'Active',
            ],
            [
                'supplier_code' => 'SUP003',
                'company_name' => 'National Traders',
                'contact_person' => 'Karan Mehta',
                'phone' => '9876543212',
                'email' => 'national@warehouse.local',
                'address' => 'Alkapuri',
                'city' => 'Vadodara',
                'state' => 'Gujarat',
                'pincode' => '390005',
                'gst_number' => null,
                'status' => 'Active',
            ],
        ];

        foreach ($suppliers as $supplier) {
            DB::table('suppliers')->updateOrInsert(
                ['supplier_code' => $supplier['supplier_code']],
                array_merge($supplier, [
                    'updated_at' => now(),
                ])
            );
        }
    }
}

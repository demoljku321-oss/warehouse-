<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'product_name' => 'Wireless Mouse',
                'product_code' => 'PRD001',
                'category' => 'Computer Accessories',
                'sub_category' => 'Mouse',
                'supplier' => 'Tech Supplier 1',
                'unit' => 'Piece',
                'purchase_price' => 350,
                'selling_price' => 499,
                'quantity' => 25,
                'minimum_stock' => 5,
                'warehouse_location' => 'Rack A1',
                'status' => 'active',
                'description' => 'Wireless computer mouse.',
                'image' => 'products/mouse.jpg',
            ],
            [
                'product_name' => 'Computer Keyboard',
                'product_code' => 'PRD002',
                'category' => 'Computer Accessories',
                'sub_category' => 'Keyboard',
                'supplier' => 'Tech Supplier 2',
                'unit' => 'Piece',
                'purchase_price' => 500,
                'selling_price' => 699,
                'quantity' => 20,
                'minimum_stock' => 5,
                'warehouse_location' => 'Rack A2',
                'status' => 'active',
                'description' => 'Standard computer keyboard.',
                'image' => 'products/keyboard.jpg',
            ],
            [
                'product_name' => 'Laptop',
                'product_code' => 'PRD003',
                'category' => 'Computers',
                'sub_category' => 'Laptop',
                'supplier' => 'Tech Supplier 3',
                'unit' => 'Piece',
                'purchase_price' => 35000,
                'selling_price' => 42000,
                'quantity' => 10,
                'minimum_stock' => 2,
                'warehouse_location' => 'Rack B1',
                'status' => 'active',
                'description' => 'Laptop computer.',
                'image' => 'products/laptop.jpg',
            ],
            [
                'product_name' => 'Headphones',
                'product_code' => 'PRD004',
                'category' => 'Audio Accessories',
                'sub_category' => 'Headphones',
                'supplier' => 'Tech Supplier 4',
                'unit' => 'Piece',
                'purchase_price' => 800,
                'selling_price' => 1199,
                'quantity' => 15,
                'minimum_stock' => 3,
                'warehouse_location' => 'Rack B2',
                'status' => 'active',
                'description' => 'Over-ear headphones.',
                'image' => 'products/headphones.jpg',
            ],
            [
                'product_name' => 'Computer Monitor',
                'product_code' => 'PRD005',
                'category' => 'Computers',
                'sub_category' => 'Monitor',
                'supplier' => 'Tech Supplier 5',
                'unit' => 'Piece',
                'purchase_price' => 7000,
                'selling_price' => 8999,
                'quantity' => 8,
                'minimum_stock' => 2,
                'warehouse_location' => 'Rack C1',
                'status' => 'active',
                'description' => 'Desktop computer monitor.',
                'image' => 'products/monitor.jpg',
            ],
        ];

        foreach ($products as $product) {
            DB::table('products')->updateOrInsert(
                ['product_code' => $product['product_code']],
                array_merge($product, [
                    'updated_at' => now(),
                ]) + [
                    'created_at' => now(),
                ]
            );
        }
    }
}

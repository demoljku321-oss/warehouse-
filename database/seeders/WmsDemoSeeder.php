<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Faker\Factory as Faker;
class WmsDemoSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('en_IN');

        DB::transaction(function () use ($faker) {

            // PRODUCT IMAGE URLS
            $images = [
                'Footwear' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=600',
                'Clothing' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=600',
                'Watches' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=600',
                'Bags' => 'https://images.unsplash.com/photo-1548036328-c9fa89d128fa?w=600',
                'Sunglasses' => 'https://images.unsplash.com/photo-1511499767150-a48a237f0083?w=600',
                'Perfumes' => 'https://images.unsplash.com/photo-1541643600914-78b084683601?w=600',
            ];

            // DOWNLOAD PRODUCT IMAGES
            $imagePaths = [];

            foreach ($images as $category => $url) {

                try {
                    $response = Http::timeout(20)->get($url);

                    if ($response->successful()) {
                        $filename = strtolower($category) . '.jpg';

                        Storage::disk('public')->put(
                            'products/' . $filename,
                            $response->body()
                        );

                        $imagePaths[$category] = 'products/' . $filename;
                    }
                } catch (\Throwable $e) {
                    $imagePaths[$category] = null;
                }
            }

            // PRODUCT DATA
            $products = [
                ['Nike Air Max', 'Footwear', 'Shoes'],
                ['Adidas Running Shoes', 'Footwear', 'Shoes'],
                ['Puma Sports Shoes', 'Footwear', 'Shoes'],
                ['Casual Sneakers', 'Footwear', 'Shoes'],
                ['Formal Shoes', 'Footwear', 'Shoes'],
                ['Cotton T-Shirt', 'Clothing', 'T-Shirt'],
                ['Mens Formal Shirt', 'Clothing', 'Shirt'],
                ['Denim Jeans', 'Clothing', 'Jeans'],
                ['Casual Jacket', 'Clothing', 'Jacket'],
                ['Mens Hoodie', 'Clothing', 'Hoodie'],
                ['Leather Wallet', 'Wallets', 'Wallet'],
                ['Travel Backpack', 'Bags', 'Backpack'],
                ['Ladies Handbag', 'Bags', 'Handbag'],
                ['Sports Bag', 'Bags', 'Bag'],
                ['Digital Watch', 'Watches', 'Watch'],
                ['Classic Wrist Watch', 'Watches', 'Watch'],
                ['Smart Watch', 'Watches', 'Watch'],
                ['Black Sunglasses', 'Sunglasses', 'Glasses'],
                ['Aviator Sunglasses', 'Sunglasses', 'Glasses'],
                ['Cotton Socks', 'Socks', 'Socks'],
                ['Sports Socks', 'Socks', 'Socks'],
                ['Leather Belt', 'Belts', 'Belt'],
                ['Casual Cap', 'Caps', 'Cap'],
                ['Baseball Cap', 'Caps', 'Cap'],
                ['Premium Perfume', 'Perfumes', 'Perfume'],
                ['Deodorant Spray', 'Perfumes', 'Deodorant'],
                ['Running Shoes Pro', 'Footwear', 'Shoes'],
                ['White Sneakers', 'Footwear', 'Shoes'],
                ['Printed T-Shirt', 'Clothing', 'T-Shirt'],
                ['Polo T-Shirt', 'Clothing', 'T-Shirt'],
                ['Slim Fit Jeans', 'Clothing', 'Jeans'],
                ['Winter Jacket', 'Clothing', 'Jacket'],
                ['School Backpack', 'Bags', 'Backpack'],
                ['Office Laptop Bag', 'Bags', 'Laptop Bag'],
                ['Luxury Watch', 'Watches', 'Watch'],
                ['Sports Watch', 'Watches', 'Watch'],
                ['Round Sunglasses', 'Sunglasses', 'Glasses'],
                ['Brown Wallet', 'Wallets', 'Wallet'],
                ['Mens Leather Belt', 'Belts', 'Belt'],
                ['Ankle Socks', 'Socks', 'Socks'],
                ['Fashion Cap', 'Caps', 'Cap'],
                ['Floral Perfume', 'Perfumes', 'Perfume'],
                ['Fresh Deodorant', 'Perfumes', 'Deodorant'],
                ['Formal Sneakers', 'Footwear', 'Shoes'],
                ['Casual Shirt', 'Clothing', 'Shirt'],
                ['Leather Handbag', 'Bags', 'Handbag'],
                ['Classic Black Belt', 'Belts', 'Belt'],
                ['Kids Sports Shoes', 'Footwear', 'Shoes'],
                ['Premium Wallet', 'Wallets', 'Wallet'],
                ['Designer Sunglasses', 'Sunglasses', 'Glasses'],
            ];

            // INSERT 50 PRODUCTS
            foreach ($products as $index => $product) {

                $category = $product[1];

                DB::table('products')->insert([
                    'product_code' => 'PRD-' . str_pad($index + 1, 5, '0', STR_PAD_LEFT),
                    'product_name' => $product[0],
                    'category' => $category,
                    'sub_category' => $product[2],
                    'unit' => 'Piece',
                    'purchase_price' => $faker->numberBetween(100, 2000),
                    'selling_price' => $faker->numberBetween(2100, 5000),
                    'quantity' => $faker->numberBetween(10, 200),
                    'minimum_stock' => $faker->numberBetween(5, 15),
                    'warehouse_location' => 'Rack-' . $faker->numberBetween(1, 20),
                    'description' => $faker->sentence(),
                    'image' => $imagePaths[$category] ?? null,
                    'status' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // INSERT 50 SUPPLIERS
            $supplierIds = [];

            for ($i = 1; $i <= 50; $i++) {

                $supplierIds[] = DB::table('suppliers')->insertGetId([
                    'supplier_code' => 'SUP-' . str_pad($i, 5, '0', STR_PAD_LEFT),
                    'company_name' => $faker->company(),
                    'contact_person' => $faker->name(),
                    'phone' => $faker->numerify('9#########'),
                    'email' => $faker->unique()->safeEmail(),
                    'address' => $faker->streetAddress(),
                    'city' => $faker->city(),
                    'state' => $faker->state(),
                    'pincode' => $faker->numerify('######'),
                    'gst_number' => $faker->numerify('##AAAAA####A#Z#'),
                    'status' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // INSERT 50 PURCHASES
            for ($i = 1; $i <= 50; $i++) {

                $subtotal = $faker->numberBetween(5000, 50000);
                $tax = round($subtotal * 0.18, 2);

                DB::table('purchases')->insert([
                    'supplier_id' => $faker->randomElement($supplierIds),
                    'bill_number' => 'BILL-' . str_pad($i, 5, '0', STR_PAD_LEFT),
                    'purchase_date' => $faker->dateTimeBetween('-6 months', 'now')->format('Y-m-d'),
                    'subtotal' => $subtotal,
                    'grand_total' => $subtotal + $tax,
                    'notes' => $faker->sentence(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

        });

        echo "50 Products, 50 Suppliers and 50 Purchases inserted successfully!";
    }
}

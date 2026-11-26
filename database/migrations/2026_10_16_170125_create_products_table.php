
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            // Product Details
            $table->string('product_code')->unique();
            $table->string('product_name');
            $table->string('category')->nullable();
            $table->string('sub_category')->nullable();
            // $table->string('supplier')->nullable();

            // Unit and Price
            $table->string('unit')->default('Piece');
            $table->decimal('purchase_price', 10, 2)->default(0);
            $table->decimal('selling_price', 10, 2)->default(0);

            // Stock Details
            $table->integer('quantity')->default(0);
            $table->integer('minimum_stock')->default(0);
            $table->string('warehouse_location')->nullable();

            // Additional Details
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('status')->default('active');

            // Timestamps
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

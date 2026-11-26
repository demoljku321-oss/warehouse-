<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'product_code',
        'product_name',
        'category',
        'sub_category',
        'supplier',
        'unit',
        'purchase_price',
        'selling_price',
        'quantity',
        'minimum_stock',
        'warehouse_location',
        'description',
        'image',
        'status',
    ];
}

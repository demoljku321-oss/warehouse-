<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'product_id',
        'name',
        'email',
        'phone',
        'address',
        'message',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

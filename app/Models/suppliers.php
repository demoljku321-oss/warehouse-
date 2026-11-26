<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class suppliers extends Model
{
    protected $table = 'suppliers';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'supplier_code',
        'company_name',
        'contact_person',
        'phone',
        'email',
        'gst_number',
        'city',
        'state',
        'pincode',
        'status',
        'address',
    ];
}

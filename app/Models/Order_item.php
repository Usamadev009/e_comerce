<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_item extends Model
{
    use HasFactory;
    protected $filable = [
        'order_id',
        'product_id',
        'price',
        'tax_amt',
        'quantiy'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }

    protected $guarded = [];
}

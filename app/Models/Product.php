<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $filable = [
        'id',
        'name',
        'sub_category_id',
        'url',
        'small_description',
        'image',
        'original_price',
        'offer_price',
        'tax_amt',
        'quantity',
        'priority',
        'p_highlight_heading',
        'p_highlights',
        'p_description_heading',
        'p_description',
        'p_details_heading',
        'p_details','status',
        'new_product',
        'featured_products',
        'popular_products',
        'offer_products',
        'status',
        'vendor_id',
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class,'sub_category_id','id');
    }

}

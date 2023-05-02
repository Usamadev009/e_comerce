<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $filable = [
        'name','description','status','url','vendor_id'
    ];


    public function category()
    {
        return $this->hasMany(Category::class);
    }

    public function subcategory()
    {
        return $this->hasMany(Subcategory::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(user::class,'vendor_id');
    }
}

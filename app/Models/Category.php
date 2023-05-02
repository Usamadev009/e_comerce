<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $filable = [
        'id','group_id','name','description','image','icon','status','vendor_id','url'
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
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

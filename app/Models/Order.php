<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Order extends Model
{
    use HasFactory;

    protected $filable = [
        'id', 'user_id','tracking_no','tracking_msg','payment_mode','payment_id','payment_status','order_status','cancel_reason','notify'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function orderitems()
    {
        return $this->hasMany(Order_item::class, 'order_id', 'id');
    }
}
